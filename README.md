## Installation

Prefered way to use composer:
```composer require "clientpad/clientpad-api-php-wrapper":"@dev"```

## Usage

```
$wrapper = new \clientpad\api\CPWrapper;
$wrapper->auth_name = 'heres_auth_name';
$wrapper->auth_pass = 'heres_auth_pass';
$wrapper->site_url = 'http://mysuperAABASFASdomen.clientpad.ru'; //heres your clientpad url
$response = $wrapper->createOrder("This is a body of order");

print_r($response); //response will be like "{"body":"This is a body of order", "id":7}"
//so its $response in our case is object already and we can use it like $response->body and do with it all what want
```
