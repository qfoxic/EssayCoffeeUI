import os
import time
from django.db import models
from django.contrib.auth.models import User
import base64
from general.models import Task, BaseModel
from django.core.exceptions import ValidationError
from django.utils.encoding import python_2_unicode_compatible

import constants as co


def get_attach_path(instance, filename):
  #return os.path.join(instance.fowner.username, filename)
  return instance.fowner.username + '/' + filename

class Upload(BaseModel):
  created = models.DateTimeField(auto_now_add=True)
  updated = models.DateTimeField(auto_now=True)
  attach = models.FileField(upload_to=get_attach_path, max_length=100)
  fowner = models.ForeignKey(User, on_delete=models.CASCADE, blank=True,
                            related_name='fowner')
  ftask = models.ForeignKey(Task, on_delete=models.CASCADE, blank=True,
                            related_name='ftask')
  access_level = models.CharField(choices=co.ACCESS_LEVELS,
                                  default=co.PRIVATE_ACCESS,
                                  max_length=1, blank=True)

  class Meta:
    db_table = 'uploads'

  def get_filename(self):
    try:
      filename = self.attach.name and self.attach.name.split('/')[1]
      if filename.startswith('IB64'):
        return base64.b64decode(filename.strip('IB64'))
      return filename
    except:
      return  self.attach.name

  def delete(self, using=None):
    self.attach.delete()
    super(Upload, self).delete(using)
