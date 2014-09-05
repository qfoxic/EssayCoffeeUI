from django import forms
from django.contrib.auth.models import Group
from django.views.generic.edit import CreateView
from django.views.generic.edit import DeleteView
from django.views.generic.edit import UpdateView
from django.views.generic import DetailView
from django.views.generic import ListView
from django.http import HttpResponseRedirect
from django.contrib import messages
from django.db.models import Count
from django.contrib.auth.views import login

from general.views import BaseView
from general.models import Task
from django.core.urlresolvers import reverse_lazy

from userprofile.models import UserProfile

#TODO. CUSTOMER DETAILS., customer edit.
class ProfileForm(forms.ModelForm):
  def __init__(self, group_name=None, user_id=None, request=None, *args, **kwargs):
    super(ProfileForm, self).__init__(*args, **kwargs)
    self.group_name = group_name
    self.user_id = user_id
    self.request = request
    if user_id:
      self.fields['password'].required = False
      self.fields['username'].required = False

  class Meta:
    model = UserProfile
    #TODO gender temporary disabled.
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
    if self.user_id:
      user = UserProfile.objects.get(pk=self.user_id)
      user.first_name=self.cleaned_data['first_name']
      user.last_name=self.cleaned_data['last_name']
      user.email=self.cleaned_data['email']
      #user.gender=self.cleaned_data['gender']
      user.country=self.cleaned_data['country']
      user.phone=self.cleaned_data['phone']
    else:
      user = UserProfile.objects.create_user(**self.cleaned_data)
      user.groups.add(Group.objects.get(name=self.group_name))
    user.save()
    return user


class CreateProfileView(BaseView, CreateView):
  form_class = ProfileForm
  queryset = UserProfile.objects.all()
  template_name = 'auth/registration.html'

  def get_form_kwargs(self):
    kwargs = super(CreateProfileView, self).get_form_kwargs()
    kwargs['group_name'] = self.group_name
    kwargs['user_id'] = None
    kwargs['request'] = self.request
    return kwargs

  def get_success_url(self):
    login(request=self.request)
    return reverse_lazy('my-orders')


class ListProfileView(BaseView, ListView):
  queryset = UserProfile.objects.all()
  template_name = 'userprofile/index.html'

  def get_context_data(self, **kwargs):
    context = super(ListProfileView, self).get_context_data(**kwargs)
    tasks_per_user = dict(Task.objects.all().values('owner').annotate(
                          tasks=Count('owner')).values_list('owner', 'tasks'))
    # Count of user's tasks.
    context['user_tasks'] = tasks_per_user
    return context


class DetailProfileView(BaseView, DetailView):
  template_name = 'userprofile/detail.html' 
  queryset = UserProfile.objects.all()


class UpdateProfileView(BaseView, UpdateView):
  template_name = 'userprofile/edit.html'
  form_class = ProfileForm
  queryset = UserProfile.objects.all()

  def get_form_kwargs(self):
    kwargs = super(UpdateProfileView, self).get_form_kwargs()
    kwargs['group_name'] = self.group_name
    kwargs['user_id'] = self.user_id()
    kwargs['request'] = self.request
    return kwargs

  def user_id(self):
    return self.get_object().pk


class RemoveProfileView(BaseView, DeleteView):
  queryset = UserProfile.objects.all()
  template_name = 'userprofile/delete.html'

  def get_success_url(self):
    return reverse_lazy('home')

  def form_invalid(self, form):
    messages.add_message(self.request, messages.ERROR, str(form.errors))
    return HttpResponseRedirect(self.get_success_url())

  def user_id(self):
    return self.get_object().pk

