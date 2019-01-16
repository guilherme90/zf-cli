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

    public function setUp()
    {
        parent::setUp();

        $this->routeList = new RouteList();
    }

    /**
     * @throws \Exception
     * @test
     */
    public function checkItemsFromArray()
    {
        $routes = $this->routeList->listRoutesFromModule(getcwd() . '/tests/files/module/User');

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
        $this->routeList->listRoutesFromModule(getcwd() . '/tests/files/module/CreditCard');
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
        static::assertSame('Customer', $routes[0]['module']);
        static::assertSame('Payment', $routes[1]['module']);
        static::assertSame('User', $routes[2]['module']);

        static::assertArrayHasKey('module', $routes[0]);
        static::assertArrayHasKey('routes', $routes[0]);
    }
}