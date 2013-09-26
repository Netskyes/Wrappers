PHP wrappers
========

Mailer
========
`mail.class.php` is a wrapper for mail function with extended functionality and easier usage.
Example
========
Sending email with optional SMTP settings else used defaults. (localhost, 25, mail address)
```php
$Mail = new Mailer([
	'SMTP' => 'www.netskyes.com',
	'SMTP_PORT' => '587',
	'SEND_FROM' => 'alex@netskyes.com',
	'TYPE' => 'html'
]);

 // Single recipient
$Mail->send("Your subject", "Your message", "someone@example.com");

// Multiple recipients
$Mail->send("Your subject", "Your message", ['someone@example.com', 'another@example.com']);
```
Retrieving SMTP settings
```php
$Mail = new Mail;
$Mail->info();
```
`$Mail->info() returns object( SMTP, SMTP_PORT, SEND_FROM )`




