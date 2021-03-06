Wrappers
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

$Mail->send('Subject', 'Message', ['someone@example.com', 'other@example.com']);
```
Retrieving SMTP settings
```php
$Mail = new Mailer;
$Mail->info();
```
`$Mail->info() returns object( SMTP, SMTP_PORT, SEND_FROM )`

Archive
========
`archive.class.php` is a simple wrapper for handling zip archives.
Example
========
```php
Archive::unzip('filename', 'destination');
```
`returns boolean`

Element DOM
========
Example
========
Creates new element and adds attributes with values to it.
```javascript
Element.new("elname", {
	id : "main",
	url : "www.sawtbeirut.com",
	style : "width: 100px; height: 100px",
	onclick : "function()"

}).attach();
```
Attach to default body, or specify element.

```javascript
Element.remove(['.div1', '#div1', '.div2', '.div3']);
```
