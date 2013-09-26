PHP wrappers
========

#### Simple Mail
Basic functionality, class is currently being under development. `mail.class.php`

```php
$Mail = new Mail;

$Mail->prepare([
  'subject' => 'Message from Simple Mail',
  'message' => 'You gota get it!'

// Optional SMTP Settings
], ['SMTP' => 'YOUR SERVER',
    'SMTP_PORT' => 'YOUR SERVERS PORT',
    'SEND_FROM' => 'mydomain@mydomain.com']

)->send('name@domain.com'); // Recipient
```
