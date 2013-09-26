PHP wrappers
========

Mail
========
`mail.class.php` is a wrapper for mail function with extended functionality and easier usage.
Example
========
```php
$Mail = new Mail;

$Mail->prepare([
  'subject' => 'Message from Simple Mail',
  'message' => 'You gota get it!'

// Optional SMTP settings
], ['SMTP' => 'YOUR SERVER',
    'SMTP_PORT' => 'YOUR SERVERS PORT',
    'SEND_FROM' => 'mydomain@mydomain.com']

)->send('name@domain.com'); // Recipient
```
SMTP settings are optional else used defaults. (localhost, 25, mail address)


