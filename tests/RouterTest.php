<?php

namespace Samfelgar\SimpleRouter\Tests;

use PHPUnit\Framework\TestCase;
use Samfelgar\SimpleRouter\Exceptions\RouteNotFoundException;
use Samfelgar\SimpleRouter\Router;

/**
 * @covers Router
 */
class RouterTest extends TestCase
{
    public function testItCanRegisterGetRoutes(): void
    {
        $router = new Router();

        $router->get('/', fn () => 'Test');

        $routes = $router->all();

        $this->assertArrayHasKey('get', $routes);
        $this->assertArrayHasKey('/', $routes['get']);
    }

    public function testItCanRegisterPostRoutes(): void
    {
        $router = new Router();

        $router->post('/', fn () => 'Test');

        $routes = $router->all();

        $this->assertArrayHasKey('post', $routes);
        $this->assertArrayHasKey('/', $routes['post']);
    }

    public function testItCanRegisterPutRoutes(): void
    {
        $router = new Router();

        $router->put('/', fn () => 'Test');

        $routes = $router->all();

        $this->assertArrayHasKey('put', $routes);
        $this->assertArrayHasKey('/', $routes['put']);
    }

    public function testItCanRegisterDeleteRoutes(): void
    {
        $router = new Router();

        $router->delete('/', fn () => 'Test');

        $routes = $router->all();

        $this->assertArrayHasKey('delete', $routes);
        $this->assertArrayHasKey('/', $routes['delete']);
    }

    public function testItCanRegisterPatchRoutes(): void
    {
        $router = new Router();

        $router->patch('/', fn () => 'Test');

        $routes = $router->all();

        $this->assertArrayHasKey('patch', $routes);
        $this->assertArrayHasKey('/', $routes['patch']);
    }

    public function testItCanResolveRoutesWithCallableActions(): void
    {
        $router = new Router();

        $expectedResult = 'Awesome response';

        $router->get('/', fn () => $expectedResult);

        $result = $router->resolve('get', '/');

        $this->assertEquals($expectedResult, $result);
    }

    public function testItCanResolveRoutesWithClassMethodsActions(): void
    {
        $router = new Router();

        $expectedResult = 'Listing all sorts of things';

        $class = $this->mockControllerClass();
        $className = get_class($class);

        $router->get('/', [$className, 'index']);

        $result = $router->resolve('get', '/');

        $this->assertEquals($expectedResult, $result);
    }

    public function testItThrowsAnExceptionIfTheRouteIsNotFound(): void
    {
        $router = new Router();

        $this->expectException(RouteNotFoundException::class);

        $router->resolve('get', '/');
    }

    private function mockControllerClass(): object
    {
        return new class() {
            public function index(): string
            {
                return 'Listing all sorts of things';
            }
        };
    }
}
