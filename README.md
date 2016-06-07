### Lift - PHP 7 micro framework

### Introduction
Lift is an opinionated PHP 7 micro framework

### Example
```php
declare(strict_types=1);
require('../vendor/autoload.php');

use Lift\Framework\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lift\Framework\Http\Response;

function getHomepage(Request $request): JsonResponse {
    $response = Response\json();
    $response->setData(['data' => ['stuff' => 'is awesome']]);
    return $response;
}

function getUserHandler (Request $request, array $args): JsonResponse {
    $response = Response\json();
    $response->setData(['data' => ['userId' => $args['id'], 'username' => 'Jason Michels']]);
    return $response;
}

$app = new App();

$routes = [
    ['httpMethod' => Request::METHOD_GET, 'route' => '/', 'handler' => 'getHomepage'],
    ['httpMethod' => Request::METHOD_GET, 'route' => '/user/{id:\d+}', 'handler' => 'getUserHandler'],
    ['httpMethod' => Request::METHOD_GET, 'route' => '/jason', 'handler' => [new Jason(), 'handle']],
    ['httpMethod' => Request::METHOD_GET, 'route' => '/makejason', 'handler' => 'makeJason'],
];

$app->run($routes);
```

### Testing
```sh
$ phpunit
```
- Be Awesome!

### Language
 - PHP 7

### License

GroundworkPHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

Authors
----
- Jason Michels
