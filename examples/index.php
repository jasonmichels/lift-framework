<?php
declare(strict_types=1);
require('../vendor/autoload.php');

use Lift\Framework\App;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Lift\Framework\Http\Response;

class Jason {
    public function handle(Request $request, array $args, string $name = null)
    {
        $response = Response\json();
        $response->setData(['data' => ['jason' => 'is from a class' . $name]]);
        return $response;
    }
}

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

function makeJason(Request $request, array $args) {
    // could do anything here to new up a class, insert constructor arguments etc...
    return (new Jason)->handle($request, $args, ' Jason Michels');
}




$app = new App();

$routes = [
    ['httpMethod' => Request::METHOD_GET, 'route' => '/', 'handler' => 'getHomepage'],
    ['httpMethod' => Request::METHOD_GET, 'route' => '/user/{id:\d+}', 'handler' => 'getUserHandler'],
    ['httpMethod' => Request::METHOD_GET, 'route' => '/jason', 'handler' => [new Jason(), 'handle']],
    ['httpMethod' => Request::METHOD_GET, 'route' => '/makejason', 'handler' => 'makeJason'],
];

$app->run($routes);