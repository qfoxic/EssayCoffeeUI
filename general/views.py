import os
import tempfile

from django.views.generic import TemplateView, View
from django.views.generic import ListView
from django.contrib.auth.views import login, logout, password_reset
from django.contrib.auth.views import password_reset_done, password_reset_confirm, password_reset_complete
from django.core.urlresolvers import reverse_lazy
from django.core.exceptions import PermissionDenied
from django.db.models import Q
from django.http import HttpResponse
from django.template import RequestContext, Template
import json

from general.models import Task
from userprofile.models import UserProfile
from history.models import list_task_events
from msgs.models import Message
from ftpstorage.models import Upload
from ftpstorage.storage import FTPStorage
from general.forms import TaskForm, SwitchStatusForm
from payments.views import get_payments_status,get_payment_url,update_payment_status 

from django.views.generic.edit import UpdateView
from django.views.generic.edit import CreateView
from django.views.generic.edit import DeleteView
from django.views.generic import DetailView

from django.views.static import serve as djserve
from django.http import HttpResponseRedirect, Http404
from django.contrib import messages

import lib.confreader as conf
import constants as co


def check_mobile(request):
  if request.META.has_key('HTTP_USER_AGENT'):
    user_agent = request.META['HTTP_USER_AGENT']
    b = co.reg_b.search(user_agent)
    v = co.reg_v.search(user_agent[0:4])
    if b or v:
      return True
  return False


def serve(request, path):
  ftp = FTPStorage()
  if not ftp.exists(path):
      raise Http404(_('"%(path)s" does not exist') % {'path': path})
  tmp_file = tempfile.NamedTemporaryFile() 
  ftp.cp(path, tmp_file)
  return djserve(request, tmp_file.name, '/')


def get_stats(request):
  return {}


def get_msgs_for_task(request, task_id):
  """Returns messages for a task."""
  return Message.objects.filter(Q(mtask_id__exact=task_id),
      Q(visibility__in=[co.MSGS_CUSTOMER])|Q(mowner_id__exact=request.user.id))


class BaseView(View):
  """Base class for all views. In addition, it loads settings from "config/" 
  module's directory and then from database.
  """
  module_name = 'global'
  owner_required = False # raise an Error if owner is required.
  allowed_groups = [] # For these groups owner won't be checked.
  action_label = 'all'

  def __init__(self, **kwargs):
    super(BaseView, self).__init__(**kwargs)
    global_settings = conf.load(co.GLOBAL_MODULE_NAME)
    module_settings = conf.load(self.module_name)
    try:
      self.settings = conf.merge(module_settings, global_settings)
    except (TypeError, AttributeError), e:
      self.settings = {}
      print 'Could not read config files for module %s: %s' % (
          self.module_name, e)

  def _check_permissions(self):
    # Do nothing by default should be overloaded for different groups.
    pass
  
  def _add_request_to_obj(self, request, instance):
    """Add request attribute to an object's model."""
    instance.__class__.cur_rqst = request
  
  def _owner_required(self, user, owner_id):
    """Checks whether user is owner of an entity."""
    user_group = UserProfile.objects.get(
        pk=owner_id).get_group()
    skip_owner_check = set(self.allowed_groups).intersection([user_group])
    if skip_owner_check:
      return
    if not user.is_superuser and not owner_id == user.pk:
      raise PermissionDenied
  
  def form_valid(self, form):
    """Main purpose of that function is to create an event."""
    self._add_request_to_obj(self.request, form.instance)
    return super(BaseView, self).form_valid(form)
  
  def dispatch(self, request, *args, **kwargs):
    if self.owner_required:
      self._owner_required(request.user, self.user_id())
    self._check_permissions()
    try:
      self._add_request_to_obj(request, self.get_object())
    except AttributeError:
      pass
    try:
      return super(BaseView, self).dispatch(request, *args, **kwargs)
    except Exception, e:
      messages.add_message(request, messages.ERROR, str(e))
      return HttpResponseRedirect('/')
    

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    user = self.request.user
    # Pass constants to templates.
    context['co'] = co
    try:
      obj = context.get('object') or self.get_object()
    except:
      obj = None
    context['perm'] = {
      'can_edit': co.CheckPermissions(user, obj, co.CAN_EDIT),
      'can_submit': co.CheckPermissions(user, obj, co.CAN_SUBMIT),
      # approve, suspect, reject
      'can_approve': co.CheckPermissions(user, obj, co.CAN_APPROVE),
      'can_reject': co.CheckPermissions(user, obj, co.CAN_REJECT),
      'can_suspect': co.CheckPermissions(user, obj, co.CAN_SUSPECT),
      # can writers mark task as sent.
      'can_send': co.CheckPermissions(user, obj, co.CAN_SEND),
      # Can admins put reports on task.
      'can_report': co.CheckPermissions(user, obj, co.CAN_REPORT),
      'can_rm_upload': co.CheckPermissions(user, obj, co.CAN_DELETE, 'upload'),
      'can_ch_visibility': co.CheckPermissions(user, obj, co.CAN_CH_VISIBILITY, 'upload'),
      'can_rm_msg': co.CheckPermissions(user, obj, co.CAN_DELETE, 'message'),
      'can_edit_msg': co.CheckPermissions(user, obj, co.CAN_EDIT, 'message'),
      'can_lock': co.CheckPermissions(user, obj, co.CAN_LOCK) and not obj.is_locked(user),
      'can_unlock': co.CheckPermissions(user, obj, co.CAN_UNLOCK) and obj.is_locked(user, by_user=True),
      'can_delete': co.CheckPermissions(user, obj, co.CAN_DELETE),
      'can_complete': co.CheckPermissions(user, obj, co.CAN_COMPLETE),
      'can_upload': co.CheckPermissions(user, obj, co.CAN_UPLOAD),
      'can_message': co.CheckPermissions(user, obj, co.CAN_MESSAGE)
    }
    context['stats'] = get_stats(self.request)
    context['action_label'] = self.action_label
    return super(BaseView, self).render_to_response(context, **response_kwargs)

  def get_context_data(self, **kwargs):
    context = super(BaseView, self).get_context_data(**kwargs)
    context['payments'] = get_payments_status()
    return context

  def get_template_names(self):
    return [self.template_name]


class LoginView(BaseView, TemplateView):
  template_name='general/login.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return login(request=self.request, template_name=self.get_template_names(),
                 extra_context=context)

  def post(self, *args, **kwargs):
    kwargs.update(self.settings)
    return login(request=self.request, template_name=self.get_template_names(),
                 extra_context=kwargs)


class LogoutView(BaseView, TemplateView):
  def render_to_response(self, context, **response_kwargs):
    return logout(request=self.request, next_page=reverse_lazy('task_list'))


class ResetPswdView(BaseView, TemplateView):
  template_name='general/password_reset_form.html'
  email_template_name='general/password_reset_email.html'

  def get_email_template(self):
    return os.path.join(self.module_name, self.email_template_name)

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_reset(request=self.request,
                          template_name=self.get_template_names(),
                          email_template_name=self.get_email_template(),
                          post_reset_redirect=reverse_lazy('pswd_reset_done'),
                          extra_context=context)

  def post(self, *args, **kwargs):
    return password_reset(request=self.request,
                          template_name=self.get_template_names(),
                          email_template_name=self.get_email_template(),
                          post_reset_redirect=reverse_lazy('pswd_reset_done'))


class ResetPswdConfirmView(BaseView, TemplateView):
  template_name='general/password_reset_confirm.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_reset_confirm(request=self.request,
        uidb64=context['uidb64'], token=context['token'],
        template_name=self.get_template_names(),
        post_reset_redirect=reverse_lazy('pswd_reset_complete'),
        extra_context=context)

  def post(self, *args, **kwargs):
    return password_reset_confirm(request=self.request,
        uidb64=kwargs['uidb64'], token=kwargs['token'],
        post_reset_redirect=reverse_lazy('pswd_reset_complete'))


class ResetPswdCompleteView(BaseView, TemplateView):
  template_name='general/password_reset_complete.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_reset_complete(request=self.request,
        template_name=self.get_template_names(), extra_context=context)


class ResetPswdDoneView(BaseView, TemplateView):
  template_name='general/password_reset_done.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_reset_done(request=self.request,
                               template_name=self.get_template_names(),
                               extra_context=context)


class TaskIndexView(BaseView, ListView):
  """Displays all tasks for signed users."""
  template_name = 'tasks/index.html'
  context_object_name = 'tasks'


class UpdateTaskView(BaseView, UpdateView):
  template_name = 'tasks/edit.html'
  form_class = TaskForm
  queryset = Task.objects.all()
  owner_required = True

  def _check_permissions(self):
    user = self.request.user
    group = user.get_group()
    try:
      obj = self.get_object()
    except:
      obj = None
    if not co.CheckPermissions(user, obj, co.CAN_EDIT):
      raise PermissionDenied
  
  def render_to_response(self, context, **response_kwargs):
    return super(UpdateTaskView, self).render_to_response(context, **response_kwargs)

  def get_form_kwargs(self):
    kwargs = super(UpdateTaskView, self).get_form_kwargs()
    kwargs['request'] = self.request
    return kwargs

  def form_invalid(self, form):
    # If form is invalid redirect to task details with an error.
    messages.add_message(self.request, messages.ERROR, str(form.errors))
    return HttpResponseRedirect(self.get_success_url())

  def user_id(self):
    return self.get_object().owner.pk


class CreateTaskView(BaseView, CreateView):
  form_class = TaskForm
  queryset = Task.objects.all()
  template_name = 'tasks/new.html'

  def get_form_kwargs(self):
    kwargs = super(CreateTaskView, self).get_form_kwargs()
    kwargs['request'] = self.request
    return kwargs


class DetailTaskView(BaseView, DetailView):
  queryset = Task.objects.all()
  template_name = 'tasks/details.html'
  
  def _check_permissions(self):
    user = self.request.user
    group = user.get_group()
    try:
      obj = self.get_object()
    except:
      obj = None
    if group == co.WRITER_GROUP:
      # For writers we should check whether task
      # has been already assigned to another writer.
      if obj and obj.assignee and user.id != obj.assignee.id:
        raise PermissionDenied

  def get_context_data(self, **kwargs):
    context = super(DetailTaskView, self).get_context_data(**kwargs)
    task_id = self.get_object().pk
    group = self.request.user.get_group()
    task_payments = context['payments'].get(task_id)
    if task_payments and task_payments[1] in [co.IN_PROCESS]:
      update_payment_status(task_payments[3], self.get_object())
    context['msgs'] = get_msgs_for_task(self.request, task_id)
    task_q = Q(ftask_id__exact=task_id)
    or_q = Q(access_level__in=(co.PUBLIC_ACCESS,))
    not_owner_q = ~Q(fowner_id__exact=self.request.user.id)
    m_ups = Upload.objects.filter(task_q, Q(fowner_id__exact=self.request.user.id))
    ups = []
    w_ups = Upload.objects.filter(fowner__groups__name=co.WRITER_GROUP).filter(task_q, or_q, not_owner_q)
    ups.extend(w_ups), ups.extend(m_ups)
    context['uploads'] = ups
       
    return context

  def user_id(self):
    return self.get_object().owner.pk


class RemoveTaskView(BaseView, DeleteView):
  queryset = Task.objects.all()
  success_url = reverse_lazy('task_list')
  template_name = 'tasks/delete.html'
  owner_required = True

  def _check_permissions(self):
    user = self.request.user
    group = user.get_group()
    try:
      obj = self.get_object()
    except:
      obj = None
    if group in co.CUSTOMER_GROUP:
      # We can remove task only in draft version.
      if not co.CheckPermissions(user, obj, co.CAN_DELETE):
        raise PermissionDenied

  def user_id(self):
    return self.get_object().owner.pk


class SwitchStatusView(UpdateTaskView):
  form_class = SwitchStatusForm 
  template_name = 'tasks/details.html'
  owner_required = False 

  def _check_permissions(self):
    pass
 
  def get_success_url(self):
    if self.object.status == co.UNPROCESSED:
      params = {'price': self.object.get_price(),
                'title': self.object.paper_title,
                'order_id': self.object.pk}
      return get_payment_url(co.LIQPAY, self.request, params)
    return self.object.to_link()


class StaticHtmlView(BaseView, TemplateView):
  def get_template_names(self):
    template_name = 'html/' + self.kwargs['path']  
    return [template_name]

class HomeView(BaseView, TemplateView):
  def get_template_names(self):
    template_name = 'html/index.html'  
    return [template_name]
