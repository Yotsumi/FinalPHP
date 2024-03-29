## FINAL PHP PROJECT (Buscema - Dumitru - Velocci)
A simple website for a basic online newspaper.

<br>**Installation**:
<br>**Requirements:**
php 7.3+
composer
Mysql / MariaDb

**How to install:**
<br><br>Copy or clone the repo folder on your device, then run
`composer install` on your shell. Use *db-dump.sql* file to create the example db. Login credentials are provided below to allow testing for dashboard features.

<br>Administrative user:
<br>**username:** admin
<br>**password:** admin

<br>Editor:
<br>**username:** user
<br>**password:** user
<br>for a regular editor.

<br>This project is based on:
## SimpleMVC

This is a mini MVC PHP framework using a simple routing system and [PSR-7](https://www.php-fig.org/psr/psr-7/) standard for HTTP messages.

The routing system is using a PHP associative array as follows:

```php
use SimpleMVC\Controller;

return [
    'GET /' => Controller\Home::class,
];
```

All the controllers are mapped with an HTTP method and a URL path separated by a space character.

A controller implements a `ControllerInterface` with one function `execute($request)`, where `$request` is PSR-7 `ServerRequestInterface`, as follows:

```php
namespace SimpleMVC\Controller;

use Psr\Http\Message\ServerRequestInterface;

interface ControllerInterface
{
    public function execute(ServerRequestInterface $request);
}
```

This project is basically a tutorial for introducing the [Model-View-Controller](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller) architecture.

This project is used in the PHP programming class of the [ITS ICT Piemonte](http://www.its-ictpiemonte.it/) school in Italy.

**NOTE:** Since this is a tutorial project, the usage of this software in a production environment is discouraged.

### Copyright

The author of this software is [Enrico Zimuel](https://github.com/ezimuel/) and other [contributors](https://github.com/ezimuel/SimpleMVC/graphs/contributors).

This software is released under the [Apache License](/LICENSE), Version 2.0.
