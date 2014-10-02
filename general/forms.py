import re
from django.contrib import messages
from django.core.mail import send_mail
from django.forms import ModelForm, ValidationError, Form, EmailField, CharField
from django.core import validators
from general.models import Task, calc_price
from payments.models import Payment
from django.contrib.auth import login, authenticate
from userprofile.forms import NewProfileForm

import constants as co

class SendContactForm(Form):
  email = EmailField(required=True)
  name = CharField(min_length=3, required=True, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'Name should contains only characters on lower or upper case.',
                              'invalid')])
  comment = CharField(max_length=1000, required=True)

  def send_email(self):
    data = self.cleaned_data
    send_mail('Request from %s' % data['email'],
              data['comment'],
              co.ADMIN_EMAIL,
              [co.INFO_EMAIL])
    


class BaseForm(ModelForm):
  class Meta:
    model = Task
    fields = () 

  def __init__(self, request=None, *args, **kwargs):
    super(BaseForm, self).__init__(*args, **kwargs)
    self.request = request

  def clean(self, *args, **kwargs):
    cleaned_data = super(BaseForm, self).clean()
    self.check_permissions(cleaned_data)
    return super(BaseForm, self).clean(*args, **kwargs)

  def clean_urgency(self):
    price = calc_price(self.data)
    if price == 0:
        raise ValidationError('With that deadline configuration is not applicable.')
    return self.cleaned_data['urgency']

  def clean_page_number(self):
      try:
          if not int(self.data['page_number']) > 0:
              raise ValidationError('For now we do not support free essays, unfortunately. Please try again later.')
      except (TypeError, ValueError):
          pass
      return self.data['page_number']


class TaskForm(BaseForm):
  class Meta(BaseForm.Meta):
    fields = ('paper_title', 'discipline', 'assigment', 'level', 'urgency',
              'spacing', 'page_number', 'style', 'source_number',
              'instructions', 'discount')

  def check_permissions(self, cleaned_data):
    """Raise an exception if user can't perform a status change."""
    user = self.request.user
    if not co.CheckPermissions(user, self.instance, co.CAN_EDIT):
      raise ValidationError('Operation can not be performed.')

  def save(self, *args, **kwargs):
    # send email
    #mail = co.ORDER_MAIL % {'first_name': self.request.user.first_name,
    #                        'domain': co.ADMIN_DOMAIN}
    #
    #    send_mail(co.ORDER_MAIL_SUBJECT, mail, co.ADMIN_EMAIL,
    #              [self.request.user.email]
    return super(TaskForm, self).save(*args, **kwargs)


class NewTaskForm(BaseForm):
  # Include auto registration if necessary.
  class Meta(BaseForm.Meta):
    fields = ('site',
              'paper_title', 'discipline', 'level', 'urgency',
              'page_number', 'style', 'spacing', 'assigment', 'source_number',
              'instructions', 'owner')

  def clean_owner(self):
    """Specifies default User parameter."""
    email = self.request.POST.get('auth_email')
    passwd = self.request.POST.get('auth_password')
    user = None
    if not self.request.user.is_authenticated():
        if email and passwd: # user entered email and password.
            user = authenticate(email=email, password=passwd)
            if not user:
              self.errors.update({'auth_error': ('Please enter correct'
                                                 ' password or email')})
              raise ValidationError('Not authorized.', code='not_auth')
            else:
              login(self.request, user)
        else: # user created new account.
            usr_form = NewProfileForm(group_name=co.CUSTOMER_GROUP,
                                      request=self.request,
                                      data=self.request.POST)
            self.request.usr_form = usr_form
            if not usr_form.is_valid():
                raise ValidationError('Entered user data are incorrect.')
            else:
                usr_form.save()
                user = authenticate(email=self.request.POST.get('email'),
                                    password=self.request.POST.get('password'))
                login(self.request, user)
    return self.request.user

  def clean_site(self):
    """Specifies default Host parameter."""
    return self.request.get_host()

  def check_permissions(self, data):
    pass

  def save(self, *args, **kwargs):
    res = super(NewTaskForm, self).save(*args, **kwargs)
    # Add unpaid payment.
    payment = Payment(powner=self.request.user, ptask=self.instance,
                      values='{}', payment_status=co.UNPAID)
    payment.save()
    return res


class SwitchStatusForm(BaseForm):
  class Meta(BaseForm.Meta):
    fields = ('status',)

  def check_status_allowed(self, next_status):
    """Raise an exception if status isn't allowed.
    Args:
      next_status: status to set.
    """
    switch_table = co.STATUS_SWITCH_TABLE
    cur_status = self.instance.status
    allowed = switch_table.get(cur_status)
    if not allowed:
      messages.error(self.request, 'This action is not eligible.')
      raise ValidationError('That status can not be modified.')
    if not next_status in allowed:
      messages.error(self.request, 'This action is not eligible.')
      raise ValidationError('This status is inappropriate. You can not set to it.')

  def check_permissions(self, cleaned_data):
    """Raise an exception if user can't perform a status change."""
    user = self.request.user
    if not co.CheckPermissions(user, self.instance, co.CAN_SUBMIT):
      raise ValidationError('Operation can not be performed.')

  def clean_status(self):
    try:
      next_status = int(self.request.POST.get('status'))
    except (TypeError, ValueError):
      next_status = None
    self.check_status_allowed(next_status)
    return next_status
  
  def save(self, *args, **kwargs):
    # When go by path UNPROCESSED->PROCESSING.
    # make task publicly visible.
    # Status that we are going to switch to.
    status = self.cleaned_data['status']
    if status == co.PROCESSING:
      self.instance.access_level = co.PUBLIC_ACCESS
    if status == co.DRAFT:
      # Add processing payment.
      payment = Payment(powner=self.request.user, ptask=self.instance,
                        values='{}', payment_status=co.IN_PROCESS,
                        payment_type=self.request.GET.get('ptype', co.TWOCHECKOUT))
      payment.save()
    return super(SwitchStatusForm, self).save(*args, **kwargs)

