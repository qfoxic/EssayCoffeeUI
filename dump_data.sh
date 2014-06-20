#!/bin/bash
./manage.py dumpdata --settings=customer_settings --indent=2 -e auth.Permission -e admin -e contenttypes -e sessions -e payments.Payment -e general.Task -e history.History -e msgs.Message -e ftpstorage.Upload > initial_data.json
