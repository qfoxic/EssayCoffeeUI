import tempfile

from django.views.generic import TemplateView, View
from django.views.generic.edit import FormView
from django.views.generic import ListView
from django.contrib.auth.views import login, logout, password_reset, password_change
from django.contrib.auth import login as auth_login
from django.contrib.auth import authenticate
from django.contrib.auth.views import password_reset_done, password_reset_confirm, password_reset_complete
from django.core.urlresolvers import reverse_lazy,reverse
from django.core.exceptions import PermissionDenied
from payments.models import Payment
from django.db.models import Q

from general.models import Task
from userprofile.models import UserProfile
from msgs.models import Message
from ftpstorage.models import Upload
from ftpstorage.storage import FTPStorage
from general.forms import TaskForm, SwitchStatusForm, NewTaskForm, SendContactForm
from payments.views import get_payments_status,get_payment_url,update_payment_status

from django.views.generic.edit import UpdateView
from django.views.generic.edit import CreateView
from django.views.generic.edit import DeleteView
from django.views.generic import DetailView

from django.views.static import serve as djserve
from django.http import HttpResponseRedirect, Http404
from django.contrib import messages
from django.core.mail import send_mail

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
  group_name = ''
  non_login_required = False

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
    if request.user.is_authenticated() and self.non_login_required:
        raise Http404
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
      'can_upload': co.CheckPermissions(user, obj, co.CAN_UPLOAD, 'upload'),
      'can_message': co.CheckPermissions(user, obj, co.CAN_MESSAGE, 'message')
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
  template_name='auth/login.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return login(request=self.request, template_name=self.get_template_names(),
                 extra_context=context)

  def post(self, *args, **kwargs):
    email = self.request.POST.get('email')
    passwd = self.request.POST.get('password')
    user = authenticate(email=email, password=passwd)
    if not user:
      return self.render_to_response({'auth_error':
          ('Please enter correct password or email')}) 
    auth_login(self.request, user)
    return HttpResponseRedirect(reverse_lazy('my-orders'))


class LogoutView(BaseView, TemplateView):
  def render_to_response(self, context, **response_kwargs):
    return logout(request=self.request, next_page=reverse_lazy('my-orders'))


class ResetPswdView(BaseView, TemplateView):
  template_name='auth/password_reset_form.html'
  email_template_name='auth/password_reset_email.html'

  def get_email_template(self):
    return self.email_template_name

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_reset(request=self.request,
                          template_name=self.get_template_names(),
                          email_template_name=self.get_email_template(),
                          from_email=co.ADMIN_EMAIL,
                          post_reset_redirect=reverse_lazy('pswd_reset_done'),
                          extra_context=context)

  def post(self, *args, **kwargs):
    return password_reset(request=self.request,
                          template_name=self.get_template_names(),
                          email_template_name=self.get_email_template(),
                          from_email=co.ADMIN_EMAIL,
                          post_reset_redirect=reverse_lazy('pswd_reset_done'))


class UpdatePswdDoneView(BaseView, TemplateView):
  template_name='auth/password_update_done.html'

  def render_to_response(self, context, **response_kwargs):
    user = self.request.user
    send_mail('Password has been updated',
              co.UPDATE_PASSWORD_EMAIL % {
                   'first_name': user.first_name},
              co.ADMIN_EMAIL,
              [user.email])
    context.update(self.settings)
    return password_reset_done(request=self.request,
                               template_name=self.get_template_names(),
                               extra_context=context)


class UpdatePswdView(BaseView, TemplateView):
  template_name='auth/password_update_form.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_change(request=self.request,
                           template_name=self.template_name,
    
                           post_change_redirect=reverse_lazy('password-change-done'),
                           extra_context=context)

  def post(self, *args, **kwargs):
    return password_change(request=self.request,
                           template_name=self.template_name,
                           post_change_redirect=reverse_lazy('password-change-done'))


class ResetPswdConfirmView(BaseView, TemplateView):
  template_name='auth/password_reset_confirm.html'

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
  template_name='auth/password_reset_complete.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_reset_complete(request=self.request,
        template_name=self.get_template_names(), extra_context=context)


class ResetPswdDoneView(BaseView, TemplateView):
  template_name='auth/password_reset_done.html'

  def render_to_response(self, context, **response_kwargs):
    context.update(self.settings)
    return password_reset_done(request=self.request,
                               template_name=self.get_template_names(),
                               extra_context=context)


class TaskIndexView(BaseView, ListView):
  """Displays all tasks for signed users.
  This handler is usually passed as redirect url after payments.
  So, we have to update order.
  """
  template_name = 'orders/my-orders.html'
  context_object_name = 'tasks'
  model=Task

  def get_context_data(self, **kwargs):
    context = super(TaskIndexView, self).get_context_data(**kwargs)
    context['draft_tasks'] = Task.get_draft_tasks(0, **{'owner__id': self.request.user.id})
    context['proc_tasks'] = (list(Task.get_processing_tasks(0, **{'owner__id': self.request.user.id}))
                            + list(Task.get_unprocessed_tasks(0, **{'owner__id': self.request.user.id}))
                            + list(Task.get_sent_tasks(0, **{'owner__id': self.request.user.id}))
                            + list(Task.get_suspicious_tasks(0, **{'owner__id': self.request.user.id}))
                            + list(Task.get_rejected_tasks(0, **{'owner__id': self.request.user.id})))
                            
    context['completed_tasks'] = Task.get_finished_tasks(0, **{'owner__id': self.request.user.id})
    return context


class SendContactView(FormView):
  template_name = 'pages/contact.html'
  form_class = SendContactForm 
  success_url = reverse_lazy('contact')
  
  def form_valid(self, form):
    form.send_email()
    messages.success(self.request, 'Thanks for your comment. We will contact to you as soon as possible.')
    return super(SendContactView, self).form_valid(form)


class UpdateTaskView(BaseView, UpdateView):
  template_name = 'orders/order_id_edit.html'
  form_class = TaskForm
  queryset = Task.objects.all()
  owner_required = True
  context_object_name = 'order'

  def _check_permissions(self):
    user = self.request.user
    try:
      obj = self.get_object()
    except:
      obj = None
    if not co.CheckPermissions(user, obj, co.CAN_EDIT):
      raise PermissionDenied
  
  def get_form_kwargs(self):
    kwargs = super(UpdateTaskView, self).get_form_kwargs()
    kwargs['request'] = self.request
    return kwargs

  def get_context_data(self, **kwargs):
    context = super(UpdateTaskView, self).get_context_data(**kwargs)
    task_id = self.get_object().pk
    task_payments = context['payments'].get(task_id)
    if task_payments and task_payments[1] in [co.IN_PROCESS]:
      update_payment_status(task_payments[3], self.get_object(), self.request,
                            task_payments[-1])
    context['msgs'] = get_msgs_for_task(self.request, task_id)
    task_q = Q(ftask_id__exact=task_id)
    m_ups = Upload.objects.filter(task_q, Q(fowner_id__exact=self.request.user.id))
    context['uploads'] = m_ups
    return context

  def get_success_url(self):
      messages.success(self.request, 'Your order has been successfully updated')
      return reverse_lazy('order-id', args=(self.get_object().pk,))

  def user_id(self):
    return self.get_object().owner.pk


class CreateTaskView(BaseView, CreateView):
  form_class = NewTaskForm
  queryset = Task.objects.all()
  template_name = 'orders/new-order.html'

  def get_form_kwargs(self):
    kwargs = super(CreateTaskView, self).get_form_kwargs()
    kwargs['request'] = self.request
    return kwargs


class DetailTaskView(BaseView, DetailView):
  queryset = Task.objects.all()
  template_name = 'orders/order_id.html'
  context_object_name = 'order'

  def get_context_data(self, **kwargs):
    context = super(DetailTaskView, self).get_context_data(**kwargs)
    order = self.get_object()
    # Simple order procesing after payment. Shouldn't be there. 
    if self.request.GET.get('merchant_order_id') and order.status == co.DRAFT:
      messages.success(self.request, 'An order has been successfully performed.')
      # Add processing payment.
      payment = Payment(powner=self.request.user, ptask=order,
                        values='{}', payment_status=co.IN_PROCESS,
                        payment_type=self.request.GET.get('ptype', co.TWOCHECKOUT))
      payment.save()
      # Move an order to UNPROCESSED.
      order.status = co.UNPROCESSED
      order.save()
    task_id = order.pk
    task_payments = context['payments'].get(task_id)
    if task_payments and task_payments[1] in [co.IN_PROCESS]:
      update_payment_status(task_payments[3], self.get_object(), self.request,
                            task_payments[-1])
    context['msgs'] = get_msgs_for_task(self.request, task_id)
    task_q = Q(ftask_id__exact=task_id)
    or_q = Q(access_level__in=(co.PUBLIC_ACCESS,))
    not_owner_q = ~Q(fowner_id__exact=self.request.user.id)
    w_ups = []
    if order.status == co.COMPLETED:
      w_ups = Upload.objects.filter(task_q, or_q, not_owner_q)
    m_ups = Upload.objects.filter(task_q, Q(fowner_id__exact=self.request.user.id))
    ups = []
    ups.extend(m_ups)
    ups.extend(w_ups)
    context['uploads'] = ups
    return context

  def user_id(self):
    return self.get_object().owner.pk


class RemoveTaskView(BaseView, DeleteView):
  queryset = Task.objects.all()
  success_url = reverse_lazy('my-orders')
  template_name = 'orders/my-orders.html'
  owner_required = True

  def _check_permissions(self):
    user = self.request.user
    try:
      obj = self.get_object()
    except:
      obj = None
    # We can remove task only in draft version.
    if not co.CheckPermissions(user, obj, co.CAN_DELETE):
      raise PermissionDenied


  def delete(self, request, *args, **kwargs):
    """
    Calls the delete() method on the fetched object and then
    redirects to the success URL.
    """
    try:
      user = request.user
      obj = self.get_object()
      send_mail(co.DELETE_ORDER_SUBJECT,
                co.DELETE_ORDER_EMAIL % {'order_title': obj.paper_title,
                                         'order_id': obj.pk,
                                         'first_name': user.first_name},
                co.ADMIN_EMAIL,
                [user.email])
    except Exception, e:
      messages.error(request, 'Could not send email to %s: %s' % (user.email, e))
    messages.success(request, 'Your order has been deleted.')
    return super(RemoveTaskView, self).delete(request, *args, **kwargs)

  def user_id(self):
    return self.get_object().owner.pk


class SwitchStatusView(UpdateTaskView):
  form_class = SwitchStatusForm
  template_name = 'orders/order_id.html'
  owner_required = False 

  def _check_permissions(self):
    pass
 
  def get_success_url(self):
    if self.object.status == co.DRAFT:
      params = {'price': self.object.get_price(),
                'title': self.object.paper_title,
                'order_id': self.object.pk}
      return get_payment_url(co.TWOCHECKOUT, self.request, params)
    return self.object.to_link()


class StaticHtmlView(BaseView, TemplateView):
  def get_template_names(self):
    template_name = 'html/' + self.kwargs['path']
    return [template_name]


class StaticPageView(BaseView, TemplateView):
  template_name = ''
  def get_template_names(self):
    return ['pages/' + self.template_name]


class HomeView(BaseView, TemplateView):
  def get_template_names(self):
    #from django.core.mail import send_mail
    #send_mail('Test', 'Here is the message.', 'workforum@ukr.net',
    #['foxandkamarus@gmail.com'], fail_silently=False)
    template_name = 'html/main.html'
    return [template_name]
