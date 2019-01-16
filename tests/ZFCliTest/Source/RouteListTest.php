<?php

namespace ZFCliTest\Source;

use PHPUnit\Framework\TestCase;
use ZFCli\Source\RouteList;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class RouteListTest extends TestCase
{
    /**
     * @var RouteList
     */
    private $routeList;

    private $modulePath;

    public function setUp()
    {
        parent::setUp();

        $this->routeList = new RouteList();

        $this->modulePath = getcwd() . '/tests/files/module/User';
    }

    /**
     * @test
     */
    public function checkArrayReturn()
    {
        static::assertIsArray($this->routeList->listRoutesFromModule($this->modulePath));
    }

    /**
     * @test
     */
    public function checkItemsFromArray()
    {
        $routes = $this->routeList->listRoutesFromModule($this->modulePath);

        static::assertNotEmpty($routes);
    }

    /**
     * @throws \Exception
     *
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage Module not found.
     */
    public function throwsExceptionWhenModuleNotFound()
    {
        $this->routeList->listRoutesFromModule(getcwd() . '/tests/files/module/Payment');
    }

    /**
     * @throws \Exception
     * @test
     */
    public function listRoutesFromModules()
    {
        $routes = $this->routeList->listRoutes(getcwd() . '/tests/files/module');

        static::assertIsArray($routes);
        static::assertTrue(count($routes) > 0);
        static::assertSame('User', $routes[0]['module']);
        static::assertArrayHasKey('module', $routes[0]);
        static::assertArrayHasKey('routes', $routes[0]);
    }
}