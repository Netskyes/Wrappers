PHP wrappers
========

#### Simple Mail
Basic functionality, class is currently being under development.

```php
$Tools = new Tools;

$Tools->mailOpts([
  'subject' => 'Message from Simple Mail', 
  'message' => 'You gota get it!'
  
// Optional SMTP Settings
], ['SMTP' => 'YOUR SERVER', 
    'SMTP_PORT' => 'YOUR SERVERS PORT', 
    'SEND_FROM' => "mydomain@mydomain.com"] 

)->mailTo("someone@domain.com"); // Recipient
```
