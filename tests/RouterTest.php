<?php

use Aiel\Exception\RouterException;
use Aiel\Route\Route;
use Aiel\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function testAddRouteWithBadMethods()
    {
        $this->expectException(RouterException::class);
        $router = new Router();
        $router->add("azeaze", "/paths", "test/test.html.twig");
    }

    public function testAddRouteWithBadMethodsMessageException()
    {
        $router = new Router();
        try {
            $router->add("azeaze", "/paths", "test/test.html.twig");
        } catch (RouterException $e) {
            $this->assertEquals("Méthode inconue: 'azeaze'", $e->getMessage());
        }
    }

    public function testAddRouteWithExsictingPath()
    {
        $this->expectException(RouterException::class);
        $router = new Router();
        $router
            ->add("get", "/paths", "test/test.html.twig")
            ->add("get", "/paths", "test/test.html.twig");
    }

    public function testAddRouteWithExsictingName()
    {
        $this->expectException(RouterException::class);
        $router = new Router();
        $router
            ->add("get", "/paths", "test/test.html.twig", "test")
            ->add("get", "/path", "test/test.html.twig", "test");
    }

    public function testGetRoutes()
    {
        $router = new Router();
        $router
            ->add("get", "/test", "test/test.html.twig")
            ->add("post", "/path", "path/path.html.twig");

        $routes = $router->getRoutes();
        $this->assertInstanceOf(Route::class, $routes["/test"]);
        $this->assertInstanceOf(Route::class, $routes["/path"]);
    }

    public function testGetRoute()
    {
        $router = new Router();
        $router
            ->add("get", "/test", "test/test.html.twig", "test")
            ->add("post", "/path", "path/path.html.twig");

        $route = $router->getRoute("test");
        $this->assertEquals("/test", $route->getPath());
    }

    public function testGetRouteWithoutName()
    {
        $this->expectException(RouterException::class);
        $router = new Router();
        $router
            ->add("get", "/test", "test/test.html.twig", "test")
            ->add("post", "/path", "path/path.html.twig");

        $route = $router->getRoute("path");
    }
}
