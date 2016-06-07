<?php
declare(strict_types=1);
namespace Lift\Framework;

use Lift\Framework\Http\RouteRequest;
use Lift\Framework\Http\Router;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class App
 *
 * Lift application
 *
 * @package Lift\Framework
 * @author Jason Michels <michelsja@icloud.com>
 * @version $Id$
 */
class App
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * Http request
     *
     * @var Request
     */
    protected $request;

    /**
     * App constructor.
     *
     * @param Router $router
     */
    public function __construct(Router $router = null)
    {
        $this->router = $router ? $router : new Router();
        $this->request = Request::createFromGlobals();
    }

    /**
     * Run the application and match routes to the requested uri
     *
     * @param $routes
     * @return App
     * @throws Exceptions\MethodNotAllowed
     * @throws Exceptions\NotFound
     */
    public function run(array $routes): App
    {
        array_walk($routes, function (array $route) {
            $this->router->routeRequestCollection[] = new RouteRequest($route['httpMethod'], $route['route'], $route['handler']);
        });

        $this->router->dispatch(
            $this->request->getPathInfo(),
            $this->request->getMethod(),
            function ($handler, array $args = []) {
                $response = call_user_func_array($handler, [$this->request, $args]);
                $response->send();
        });

        return $this;
    }
}
