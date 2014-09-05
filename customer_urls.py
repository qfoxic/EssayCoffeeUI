from django.conf.urls import patterns, include, url
from django.contrib.auth.decorators import login_required
from django.core.urlresolvers import reverse_lazy

from general.views import RemoveTaskView,SwitchStatusView, LoginView, HomeView
from general.views import StaticPageView
from general.views import CreateTaskView,UpdateTaskView,DetailTaskView,TaskIndexView
from msgs.views import CreateMsgView, RemoveMsgView, ListMsgsView,DetailMsgView
from ftpstorage.views import UploadFileView,RemoveUploadView


from userprofile.views import CreateProfileView, UpdateProfileView

import constants as co

task_rm = login_required(RemoveTaskView.as_view(), login_url=reverse_lazy('login'))

msg_add = login_required(CreateMsgView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
msg_rm = login_required(RemoveMsgView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
msg_list = login_required(ListMsgsView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
msg_detail = login_required(DetailMsgView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
upload_file = login_required(UploadFileView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
upload_rm = login_required(RemoveUploadView.as_view(module_name='customer'), login_url=reverse_lazy('login'))

user_new = CreateProfileView.as_view(module_name='customer',
                                     group_name=co.CUSTOMER_GROUP)
user_edit = login_required(UpdateProfileView.as_view(module_name='customer',  owner_required=True),
                           login_url=reverse_lazy('login'))

task_list = lambda request: login_required(
    TaskIndexView.as_view(module_name='customer', action_label='my orders'),
    login_url=reverse_lazy('login'))(request)
task_details = login_required(DetailTaskView.as_view(module_name='customer', owner_required=True),
                              login_url=reverse_lazy('login'))
task_new = CreateTaskView.as_view(module_name='customer')
task_status = login_required(
  SwitchStatusView.as_view(module_name='customer'),
  login_url=reverse_lazy('login'))
task_update = login_required(
  UpdateTaskView.as_view(module_name='customer'),
  login_url=reverse_lazy('login'))

urlpatterns = patterns('',
	# Pages
	url(r'^$', HomeView.as_view(), name='home'),
    url(r'service', StaticPageView.as_view(module_name='customer',
                                           template_name='service.html'), name='service'),
    url(r'pricing', StaticPageView.as_view(module_name='customer',
                                           template_name='pricing.html'), name='pricing'),
    url(r'guarantees', StaticPageView.as_view(module_name='customer',
                                              template_name='guarantees.html'), name='guarantees'),
    url(r'faq', StaticPageView.as_view(module_name='customer',
                                       template_name='faq.html'), name='faq'),
    url(r'contact', StaticPageView.as_view(module_name='customer',
                                           template_name='contact.html'), name='contact'),

    # Auth
    url(r'registration', user_new, name='registration'),
    url(r'forgot', user_new, name='forgot'),
    url(r'^login/$', LoginView.as_view(module_name='customer'), name='login'),
										   
	# Account	
    url(r'my-account', StaticPageView.as_view(module_name='customer',
                                           template_name='my-account.html'), name='my-account'),
    url(r'password-change', StaticPageView.as_view(module_name='customer',
                                           template_name='password-change.html'), name='password-change'),
    url(r'profile/(?P<pk>\d+)/$', user_edit, name='user_details'),
    url(r'profile/(?P<pk>\d+)/edit$', user_edit, name='user_edit'),

	# Orders
    url(r'new-order', StaticPageView.as_view(module_name='customer',
                                           template_name='new-order.html'), name='new-order'),	
    #url(r'^my-orders/$', task_list, name='my-orders'),
    url(r'my-orders', StaticPageView.as_view(module_name='customer',
                                           template_name='my-orders.html'), name='my-orders'),		   
    url(r'order-id', StaticPageView.as_view(module_name='customer',
                                           template_name='order_id.html'), name='order-id'),
    url(r'order-id-edit', StaticPageView.as_view(module_name='customer',
                                           template_name='order_id_edit.html'), name='order-id-edit'),	

										   
										   
    url(r'payment-id',  HomeView.as_view(), name='payment-id'),
										   
										   
										   
    url(r'^task/(?P<pk>\d+)/$', task_details, name='task_view'),
    url(r'^task/(?P<pk>\d+)/remove$', task_rm, name='task_remove'),
    url(r'^task/new$', task_new, name='new-order'),
    url(r'^task/(?P<pk>\d+)/edit$', task_update, name='task_edit'),
    url(r'^task/(?P<pk>\d+)/status$', task_status, name='task_status'),

    url(r'^msg/(?P<task_id>\d+)/new$', msg_add, name='msg_add'),
    #url(r'^msg/(?P<pk>\d+)/remove$', msg_rm, name='msg_remove'),
    url(r'^msgs/$', msg_list, name='msgs_list'),
    url(r'^msg/(?P<pk>\d+)/$', msg_detail, name='msg_detail'),

    url(r'^upload/(?P<task_id>\d+)/new$', upload_file, name='upload_file'),
    url(r'^upload/(?P<pk>\d+)/remove$', upload_rm, name='upload_remove'),
    #url(r'^upload/(?P<pk>\d+)/visibility$', upload_visibility, name='upload_visibility'),



    url(r'', include('common_urls')),
)

