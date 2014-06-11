from django.forms import ModelForm, ValidationError
from ftpstorage.models import Upload
from userprofile.models import UserProfile
from general.models import Task
from general.forms import BaseForm
from django.core.exceptions import PermissionDenied

import constants as co


class UploadForm(BaseForm):
  class Meta(BaseForm.Meta):
    model = Upload
    fields = ('attach', 'fowner', 'access_level', 'ftask')

  def __init__(self, request=None, task_id=None, *args, **kwargs):
    super(UploadForm, self).__init__(*args, **kwargs)
    self.request = request
    self.task_id = task_id

  def clean_fowner(self):
    """Specifies default User parameter."""
    return self.request.user

  def clean_ftask(self):
    """Specifies default task for a comment."""
    return Task.objects.get(pk=self.task_id)
  
  def check_permissions(self, cleaned_data):
    """Raises an exception if there are no permissions to save a form."""
    if not co.CheckPermissions(self.request.user,
        self.cleaned_data['ftask'], co.CAN_UPLOAD):
      raise ValidationError('You can not upload file.') 


