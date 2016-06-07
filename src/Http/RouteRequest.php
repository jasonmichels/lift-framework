<?php
declare(strict_types=1);
namespace Lift\Framework\Http;

/**
 * Class RouteRequest
 *
 * An instance of a route
 *
 * @package Lift\Framework\Http
 * @author Jason Michels <michelsja@icloud.com>
 * @version $Id$
 */
class RouteRequest
{
    /**
     * @var string
     */
    public $route;

    /**
     * @var callable
     */
    public $handler;

    /**
     * @var string
     */
    public $httpMethod;

    /**
     * RouteRequest constructor.
     * @param string $httpMethod
     * @param string $route
     * @param callable $handler
     */
    public function __construct(string $httpMethod, string $route, callable $handler)
    {
        $this->httpMethod = $httpMethod;
        $this->route = $route;
        $this->handler = $handler;
    }
}
