from django.db import models
from django.contrib.auth.models import User
from general.models import Task
import constants as co


class Payment(models.Model):
  howner = models.ForeignKey(User, on_delete=models.CASCADE, null=True, blank=True,
                             related_name='howner')
  htask = models.ForeignKey(Task, on_delete=models.CASCADE, null=True, blank=True,
                            related_name='htask')
  payment_status = models.SmallIntegerField(choices=co.PAYMENT_STATUS, default=co.UNPAID)
  created = models.DateTimeField(auto_now_add=True)
  updated = models.DateTimeField(auto_now=True)
  values = models.CharField(max_length=5000)# incoming data from payment system. 

  class Meta:
    db_table = 'payments'
