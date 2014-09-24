from django.conf.urls import patterns, url
from django.contrib.auth.decorators import login_required
from django.core.urlresolvers import reverse_lazy

from general.views import RemoveTaskView,SwitchStatusView, HomeView
from general.views import StaticPageView
from general.views import CreateTaskView,UpdateTaskView,DetailTaskView,TaskIndexView
from msgs.views import CreateMsgView, RemoveMsgView, ListMsgsView,DetailMsgView
from ftpstorage.views import UploadFileView,RemoveUploadView
from ftpstorage.views import DownloadFileView
from general.views import LoginView, LogoutView, ResetPswdView, StaticHtmlView
from general.views import ResetPswdDoneView, ResetPswdConfirmView, ResetPswdCompleteView, UpdatePswdView, UpdatePswdDoneView

from userprofile.views import CreateProfileView, UpdateProfileView

import constants as co

task_rm = login_required(RemoveTaskView.as_view(), login_url=reverse_lazy('login'))

msg_add = login_required(CreateMsgView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
msg_rm = login_required(RemoveMsgView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
msg_list = login_required(ListMsgsView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
msg_detail = login_required(DetailMsgView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
upload_file = login_required(UploadFileView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
upload_rm = login_required(RemoveUploadView.as_view(module_name='customer'), login_url=reverse_lazy('login'))
upload_download = login_required(DownloadFileView.as_view(), login_url=reverse_lazy('login'))
user_new = CreateProfileView.as_view(module_name='customer', non_login_required=True,
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
    url(r'^custom-essays/$', StaticPageView.as_view(module_name='customer', template_name='custom-essays.html'),
                                              name='custom-essays'),
    url(r'^pricing/$', StaticPageView.as_view(module_name='customer', template_name='pricing.html'),
                                              name='pricing'),
    url(r'^faq/$', StaticPageView.as_view(module_name='customer', template_name='faq.html'),
                                          name='faq'),
    url(r'^contact/$', StaticPageView.as_view(module_name='customer', template_name='contact.html'),
                                              name='contact'),
    url(r'^terms-conditions/$', StaticPageView.as_view(module_name='customer', template_name='terms-conditions.html'),
                                              name='terms-conditions'),
    url(r'^cookie-policy/$', StaticPageView.as_view(module_name='customer', template_name='cookie-policy.html'),
                                              name='cookie-policy'),
    url(r'^money-back-guarantee/$', StaticPageView.as_view(module_name='customer', template_name='money-back-guarantee.html'),
                                              name='money-back-guarantee'),
    url(r'^privacy-policy/$', StaticPageView.as_view(module_name='customer', template_name='privacy-policy.html'),
                                              name='privacy-policy'),
    url(r'^plagiarism-free-guarantee/$', StaticPageView.as_view(module_name='customer', template_name='plagiarism-free-guarantee.html'),
                                              name='plagiarism-free-guarantee'),
    url(r'^progressive-delivery/$', StaticPageView.as_view(module_name='customer', template_name='progressive-delivery.html'),
                                              name='progressive-delivery'),
    url(r'^revisions-policy/$', StaticPageView.as_view(module_name='customer', template_name='revisions-policy.html'),
                                              name='revisions-policy'),
    url(r'^disclaimer/$', StaticPageView.as_view(module_name='customer', template_name='disclaimer.html'),
                                              name='disclaimer'),
											  
    url(r'^research-papers/$', StaticPageView.as_view(module_name='customer', template_name='research-papers.html'),
                                              name='research-papers'),
    url(r'^term-papers/$', StaticPageView.as_view(module_name='customer', template_name='term-papers.html'),
                                              name='term-papers'),
    url(r'^coursework-writing/$', StaticPageView.as_view(module_name='customer', template_name='coursework-writing.html'),
                                              name='coursework-writing'),
											  
    # Auth
    url(r'^registration/$', user_new, name='registration'),
    url(r'^login/$', LoginView.as_view(module_name='customer', non_login_required=True), name='login'),
    url(r'^logout/$', LogoutView.as_view(module_name='customer'), name='logout'),
    # Account
    url(r'^profile/(?P<pk>\d+)/$', user_edit, name='my-account'),
    url(r'^profile/(?P<pk>\d+)/edit$', user_edit, name='my-account-edit'),
    url(r'^forgot/$', ResetPswdView.as_view(module_name='customer', non_login_required=True), name='forgot'),
    url(r'^resetdone/$', ResetPswdDoneView.as_view(module_name='customer', non_login_required=True), name='pswd_reset_done'),
    url(r'^resetconfirm/(?P<uidb64>.*)/(?P<token>.*)$', ResetPswdConfirmView.as_view(module_name='customer', non_login_required=True), name='pswd_reset_confirm'),
    url(r'^resetcomplete/$', ResetPswdCompleteView.as_view(module_name='customer', non_login_required=True), name='pswd_reset_complete'),
    url(r'^password-change/$', UpdatePswdView.as_view(module_name='customer'), name='password-change'),
    url(r'^change-done/$', UpdatePswdDoneView.as_view(module_name='customer'), name='password-change-done'),
    # Orders
    url(r'^orders/$', task_list, name='my-orders'),
    url(r'^order/new/$', task_new, name='new-order'),
    url(r'^order/(?P<pk>\d+)/$', task_details, name='order-id'),
    url(r'^order/(?P<pk>\d+)/edit/$', task_update, name='order-id-edit'),
    url(r'^order/(?P<pk>\d+)/buy/$', task_status, name='order-id-buy'),
    url(r'^order/(?P<pk>\d+)/delete/$', task_rm, name='order-id-delete'),
    url(r'^upload/(?P<task_id>\d+)/new/$', upload_file, name='order-upload'),
    url(r'^upload/(?P<pk>\d+)/download/$', upload_download, name='order-upload-download'),
    url(r'^msg/(?P<task_id>\d+)/new$', msg_add, name='order-msg-new'),
    url(r'^html/(?P<path>.*)$', StaticHtmlView.as_view(), name='html'),
    url(r'^media/(?P<path>.*)$', 'django.views.static.serve'),
)


