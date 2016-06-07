<?php
declare(strict_types=1);
namespace Lift\Framework\Http;

use Lift\Framework\Exceptions\MethodNotAllowed;
use Lift\Framework\Exceptions\NotFound;
use FastRoute;

/**
 * Class Router
 *
 * Router will match routes
 *
 * @package Lift\Framework\Http
 * @author Jason Michels <michelsja@icloud.com>
 * @version $Id$
 */
class Router
{
    /**
     * Route request collection
     *
     * @var array
     */
    public $routeRequestCollection = [];

    /**
     * Dispatch router
     *
     * @param string $requestUri
     * @param string $requestMethod
     * @param callable $callable
     * @return Router
     * @throws MethodNotAllowed
     * @throws NotFound
     */
    public function dispatch(string $requestUri, string $requestMethod, callable $callable): Router
    {
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $routeCollector) {

            array_walk($this->routeRequestCollection, function (RouteRequest $routeRequest) use ($routeCollector) {
                $routeCollector->addRoute($routeRequest->httpMethod, $routeRequest->route, $routeRequest->handler);
            });
            
        });

        $routeInfo = $dispatcher->dispatch($requestMethod, $requestUri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                throw new NotFound('Unable to match request for route ' . $requestUri . ' and method: ' . $requestMethod);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                throw new MethodNotAllowed($requestMethod . ' is not allowed for route', 0, null, $allowedMethods);
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                call_user_func_array($callable, [$handler, $vars]);
                break;
        }

        return $this;
    }
}
