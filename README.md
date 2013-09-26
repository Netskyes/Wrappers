PHP wrappers
========

Mail
========
`mail.class.php` is a wrapper for mail function with extended functionality and easier usage.
Example
========
Sending email with optional SMTP settings else used defaults. (localhost, 25, mail address)
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
Retrieving SMTP settings
```php
$Mail = new Mail;
$Mail->info();
```
`$Mail->info() returns object( SMTP, SMTP_PORT, SEND_FROM )`




