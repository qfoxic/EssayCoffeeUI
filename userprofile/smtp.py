from django.core.mail.backends.smtp import EmailBackend
import smtplib

EMAIL_HOST = 'smtp.ukr.net'
EMAIL_HOST_PASSWORD = 'QAZqaz1983'
EMAIL_HOST_USER = 'workforum@ukr.net'
EMAIL_PORT = 465


class SSLEmailBackend(EmailBackend):
    def open(self):
        """
            Ensures we have a connection to the email server. Returns whether or
            not a new connection was required (True or False).
        """
        if self.connection:
            # Nothing to do if the connection is already open.
            return False
        try:
            self.connection = smtplib.SMTP_SSL(EMAIL_HOST, EMAIL_PORT)
            self.connection.login(EMAIL_HOST_USER, EMAIL_HOST_PASSWORD)
            return True
        except smtplib.SMTPException:
            if not self.fail_silently:
                raise
