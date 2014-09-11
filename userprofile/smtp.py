from django.core.mail.backends.smtp import EmailBackend
import smtplib
import constants as co


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
            self.connection = smtplib.SMTP_SSL(co.EMAIL_HOST, co.EMAIL_PORT)
            self.connection.login(co.EMAIL_HOST_USER, co.EMAIL_HOST_PASSWORD)
            return True
        except smtplib.SMTPException:
            if not self.fail_silently:
                raise
