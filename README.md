PHP wrappers
========

#### Simple Mail `mail.class.php`

Get php.ini SMTP server settings
```php
$Mail = new Mail;
$Mail->info(); // Returns data object

/*
Returns:
  object(stdClass)[2]
    public 'SMTP' => string 'YOUR SERVER' (length=11)
    public 'SMTP_PORT' => string 'YOUR SERVERS PORT' (length=17)
    public 'SEND_FROM' => string 'mydomain@mydomain.com' (length=21)
*/
```

Basic mail functionality `prepare([array])`
```php 
$Mail = new Mail;

$Mail->prepare([
  'subject' => 'Message from Simple Mail',
  'message' => 'You gota get it!']

)->send('name@domain.com');

// Returns: boolean
```

With optional SMTP settings `(array, array[optional])`

```php
$Mail = new Mail;

$Mail->prepare([
  'subject' => 'Message from Simple Mail',
  'message' => 'You gota get it!'

// Optional SMTP settings
], ['SMTP' => 'YOUR SERVER',
    'SMTP_PORT' => 'YOUR SERVERS PORT',
    'SEND_FROM' => 'mydomain@mydomain.com']

)->send('name@domain.com');

// Returns: boolean
```
