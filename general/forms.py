from django.forms import ModelForm, ValidationError, FileField
from general.models import Task
from payments.models import Payment
from django.contrib.auth import login, authenticate
from userprofile.forms import NewProfileForm

import constants as co


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


class TaskForm(BaseForm):
  attach = FileField(required=False)
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
        if email and passwd:
            user = authenticate(email=email, password=passwd)
            if not user:
              self.errors.update({'auth_error': ('Please enter correct'
                                                 ' password or email')})
              raise ValidationError('Not authorized.', code='not_auth')
            else:
              login(self.request, user)
        else:
            usr_form = NewProfileForm(group_name=co.CUSTOMER_GROUP,
                                      request=self.request,
                                      data=self.request.POST)
            self.request.usr_form = usr_form
            if not usr_form.is_valid():
                raise ValidationError('Entered user data are incorrect.')
            else:
                usr_form.save()
                user = authenticate(username=self.request.POST.get('username'),
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
      raise ValidationError('That status can not be modified.')
    if not next_status in allowed:
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
    if status == co.UNPROCESSED:
      # Add processing payment.
      payment = Payment(powner=self.request.user, ptask=self.instance,
                        values='{}', payment_status=co.IN_PROCESS,
                        payment_type=self.request.GET.get('ptype', co.LIQPAY))
      payment.save()
    return super(SwitchStatusForm, self).save(*args, **kwargs)
