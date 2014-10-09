import re
from userprofile.models import UserProfile
from django import forms
from django.core import validators
from django.contrib.auth.models import Group
from django.core.mail import send_mail
from django.contrib import messages
from django.contrib.auth import login, authenticate

import constants as co

class ProfileForm(forms.ModelForm):
  first_name = forms.CharField(min_length=3, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'First name should contains only characters on lower or upper case.',
                              'invalid')])
  last_name = forms.CharField(min_length=3, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'Last name should contains only characters on lower or upper case.',
                              'invalid')])
  country =  forms.CharField(min_length=3, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'Country should contains only characters on lower or upper case.',
                              'invalid')])
  phone = forms.CharField(min_length=5, max_length=20, required=True,
                          validators=[validators.RegexValidator(re.compile('^[\d ]+$'), 'Phone number should contains only numbers and spaces')])

  def __init__(self, group_name=None, request=None, *args, **kwargs):
    super(ProfileForm, self).__init__(*args, **kwargs)
    self.group_name = group_name
    self.request = request

  class Meta:
    model = UserProfile
    fields = ['password', 'first_name', 'last_name',
              'country', 'phone', 'site', 'email']

  def clean_phone(self):
    phone =self.request.POST.get('phone')
    phone = phone.strip(' -')
    if len(phone) > 20:
      raise forms.ValidationError('Phone should contains less then 15 numbers',
                                  code='number_overflow')
    return phone

  def clean_site(self):
    """Specifies default Host parameter."""
    return self.request.get_host()

  def clean_password(self):
    if self.request.POST.get('password') != self.request.POST.get('password2'):
      raise forms.ValidationError('Passwords do not match.')
    return self.request.POST.get('password')

  def save(self, commit=True):
    user = UserProfile.objects.create_user(**self.cleaned_data)
    user.groups.add(Group.objects.get(name=self.group_name))
    user.save()
    messages.success(self.request, 'Your user profile has been saved.')
    return user


class EditProfileForm(forms.ModelForm):
  first_name = forms.CharField(min_length=3, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'First name should contains only characters on lower or upper case.',
                              'invalid')])
  last_name = forms.CharField(min_length=3, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'Last name should contains only characters on lower or upper case.',
                              'invalid')])
  country =  forms.CharField(min_length=3, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'Country should contains only characters on lower or upper case.',
                              'invalid')])
  phone = forms.CharField(min_length=5, max_length=20, required=True,
                          validators=[validators.RegexValidator(re.compile('^[\d ]+$'), 'Phone number should contains only numbers and spaces')])
  def __init__(self, user_id=None, request=None, *args, **kwargs):
    super(EditProfileForm, self).__init__(*args, **kwargs)
    self.user_id = user_id
    self.request = request
    self.fields['email'].required = False

  class Meta:
    model = UserProfile
    fields = ['first_name', 'last_name', 'country', 'phone', 'email']

  def clean_phone(self):
    phone =self.request.POST.get('phone')
    phone = phone.strip(' -')
    if len(phone) > 20:
      raise forms.ValidationError('Phone should contains less then 15 numbers',
                                  code='number_overflow')
    return phone

  def save(self, commit=True):
    user = UserProfile.objects.get(pk=self.user_id)
    user.first_name=self.cleaned_data['first_name']
    user.last_name=self.cleaned_data['last_name']
    user.country=self.cleaned_data['country']
    user.phone=self.cleaned_data['phone']
    user.save()
    messages.success(self.request, 'Your user profile has been updated.')
    return user


class NewProfileForm(forms.ModelForm):
  email = forms.EmailField(required=True)
  first_name = forms.CharField(min_length=3,  required=True, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'First name should contains only characters on lower or upper case.',
                              'invalid')])
  last_name = forms.CharField(min_length=3,  required=True, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'Last name should contains only characters on lower or upper case.',
                              'invalid')])
  country = forms.CharField(min_length=3,  required=True, validators=[
    validators.RegexValidator(re.compile('^[a-zA-Z]+$'),
                              'Country should contains only characters on lower or upper case.',
                              'invalid')])
  password = forms.CharField(min_length=6, required=True)
  phone = forms.CharField(min_length=5, max_length=20, required=True,
                          validators=[validators.RegexValidator(re.compile('^[\d ]+$'), 'Phone number should contains only numbers and spaces')])

  def __init__(self, group_name=None, request=None, *args, **kwargs):
    super(NewProfileForm, self).__init__(*args, **kwargs)
    self.group_name = group_name
    self.request = request

  class Meta:
    model = UserProfile
    fields = ['password', 'first_name', 'last_name', 'email',
              'country', 'phone', 'site']
  
  def clean_phone(self):
    phone = self.request.POST.get('phone')
    phone = phone.replace(' ', '')
    phone = phone.replace('-', '')
    if len(phone) > 20:
      raise forms.ValidationError('Phone should contains less then 15 numbers',
                                  code='number_overflow')
    return phone

  def clean_site(self):
    """Specifies default Host parameter."""
    return self.request.get_host()

  def clean_email(self):
    if UserProfile.objects.filter(email=self.request.POST.get('email')):
      raise forms.ValidationError('Email already exists',
                                  code='email_exists')
    return self.request.POST.get('email')

  def clean_password(self):
    if self.request.POST.get('password') != self.request.POST.get('password2'):
      raise forms.ValidationError('Passwords do not match.')
    return self.request.POST.get('password')

  def save(self, commit=True):
    self.cleaned_data['username'] = self.cleaned_data['email']
    user = UserProfile.objects.create_user(**self.cleaned_data)
    user.groups.add(Group.objects.get(name=self.group_name))
    user.save()
    try:
      send_mail(co.NEW_PROFILE_SUBJECT,
                co.NEW_PROFILE_EMAIL % {'first_name': user.first_name,
                                        'domain': co.ADMIN_DOMAIN,
                                        'username': user.username,
                                        'email': user.email},
                co.ADMIN_EMAIL,
                [user.email])
    except Exception, e:
      messages.error(self.request, 'Could not send email to %s: %s' % (user.email, e))
    user = authenticate(email=self.cleaned_data['email'],
                        password=self.cleaned_data['password'])
    login(self.request, user)
    return user

