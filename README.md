PHP wrappers
========

Mailer
========
`mailer.class.php` is a wrapper for mail function with extended functionality and easier usage.
Example
========
Sending email with optional SMTP settings else used defaults. (localhost, 25, mail address)
```php
// Optional settings
$Mail = new Mailer([
	'SMTP' => 'SERVER ADDRESS',
	'SMTP_PORT' => 'SERVER PORT',
	'SEND_FROM' => 'you@example.com',
	'TYPE' => 'html' // Default plain
]);

$Mail->send('Subject', 'Message', ['someone@example.com', 'other@example.com']); // String for one recipient else array
```
Retrieving SMTP settings
```php
$Mail = new Mailer;
$Mail->info();
```
`$Mail->info() returns object( SMTP, SMTP_PORT, SEND_FROM )`




