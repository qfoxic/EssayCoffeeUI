import re
from userprofile.models import UserProfile
from django import forms
from django.core import validators
from django.contrib.auth.models import Group
from django.core.mail import send_mail

import constants as co

class ProfileForm(forms.ModelForm):
  username = forms.CharField(min_length=4, max_length=30, validators=[
    validators.RegexValidator(re.compile('^[\w]+$'),
                              'Username should contains only characters on lower or upper case.',
                              'invalid')])
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
  def __init__(self, group_name=None, request=None, *args, **kwargs):
    super(ProfileForm, self).__init__(*args, **kwargs)
    self.group_name = group_name
    self.request = request

  class Meta:
    model = UserProfile
    fields = ['username', 'password', 'first_name', 'last_name', 'email',
              'country', 'phone', 'site']

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
    user = UserProfile.objects.create_user(**self.cleaned_data)
    user.groups.add(Group.objects.get(name=self.group_name))
    user.save()
    return user


class EditProfileForm(forms.ModelForm):
  username = forms.CharField(min_length=4, max_length=30, validators=[
                             validators.RegexValidator(re.compile('^[\w]+$'),
                              'Username should contains only characters on lower or upper case.',
                              'invalid')])
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
  def __init__(self, user_id=None, request=None, *args, **kwargs):
    super(EditProfileForm, self).__init__(*args, **kwargs)
    self.user_id = user_id
    self.request = request
    self.fields['username'].required = False
    self.fields['email'].required = False

  class Meta:
    model = UserProfile
    fields = ['username','email', 'first_name', 'last_name', 'country', 'phone']

  def save(self, commit=True):
    user = UserProfile.objects.get(pk=self.user_id)
    user.first_name=self.cleaned_data['first_name']
    user.last_name=self.cleaned_data['last_name']
    user.country=self.cleaned_data['country']
    user.phone=self.cleaned_data['phone']
    user.save()
    return user


class NewProfileForm(forms.ModelForm):
  email = forms.EmailField(required=True)
  username = forms.CharField(min_length=4, required=True, max_length=30, validators=[
                             validators.RegexValidator(re.compile('^[\w]+$'),
                             'Username should contains only characters on lower or upper case.',
                             'invalid')])
  first_name = forms.CharField(min_length=3,  required=True, validators=[
    validators.RegexValidator(re.compile('^[\w]+$'),
                              'First name should contains only characters on lower or upper case.',
                              'invalid')])
  last_name = forms.CharField(min_length=3,  required=True, validators=[
    validators.RegexValidator(re.compile('^[\w]+$'),
                              'Last name should contains only characters on lower or upper case.',
                              'invalid')])
  country = forms.CharField(min_length=3,  required=True, validators=[
    validators.RegexValidator(re.compile('^[\w]+$'),
                              'Country should contains only characters on lower or upper case.',
                              'invalid')])
  password = forms.CharField(min_length=4, required=True)

  def __init__(self, group_name=None, request=None, *args, **kwargs):
    super(NewProfileForm, self).__init__(*args, **kwargs)
    self.group_name = group_name
    self.request = request

  class Meta:
    model = UserProfile
    fields = ['username', 'password', 'first_name', 'last_name', 'email',
              'country', 'phone', 'site']

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
    user = UserProfile.objects.create_user(**self.cleaned_data)
    user.groups.add(Group.objects.get(name=self.group_name))
    user.save()
    send_mail(co.NEW_PROFILE_SUBJECT,
              co.NEW_PROFILE_EMAIL % {'first_name': user.first_name,
                                      'domain': co.ADMIN_DOMAIN,
                                      'username': user.username,
                                      'email': user.email},
              co.ADMIN_EMAIL,
              [user.email], fail_silently=False)
    return user
