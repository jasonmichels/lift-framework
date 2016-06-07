<?php namespace Lift\Framework\Tests;

use Lift\Framework\App;
use Lift\Framework\Http\Router;
use \Mockery as mockery;
use Lift\Framework\Contracts\Application;

/**
 * Class AppTest
 *
 * Tests for main application code
 *
 * @package Lift\Tests
 * @author Jason Michels <michelsja@icloud.com>
 * @version $Id$
 */
class AppTest extends TestCase
{
    /**
     * Test the app returns the correct contract
     */
    public function testAppReturnsCorrectInstance()
    {
        $requestUri = "/";
        $requestMethod = "GET";
        $router = mockery::mock(Router::class);

        $app = new App($requestUri, $requestMethod, $router);

        $this->assertInstanceOf(Application::class, $app);
    }
}
