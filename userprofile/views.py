from django.views.generic.edit import CreateView
from django.views.generic.edit import DeleteView
from django.views.generic.edit import UpdateView
from django.views.generic import ListView
from django.http import HttpResponseRedirect
from django.contrib import messages
from django.db.models import Count
from django.contrib.auth.views import login

from general.views import BaseView
from general.models import Task
from django.core.urlresolvers import reverse_lazy

from userprofile.models import UserProfile
from userprofile.forms import NewProfileForm, EditProfileForm


class CreateProfileView(BaseView, CreateView):
  form_class = NewProfileForm
  queryset = UserProfile.objects.all()
  template_name = 'auth/registration.html'

  def get_form_kwargs(self):
    kwargs = super(CreateProfileView, self).get_form_kwargs()
    kwargs['group_name'] = self.group_name
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


class UpdateProfileView(BaseView, UpdateView):
  template_name = 'profile/profile.html'
  form_class = EditProfileForm
  queryset = UserProfile.objects.all()

  def get_form_kwargs(self):
    kwargs = super(UpdateProfileView, self).get_form_kwargs()
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

