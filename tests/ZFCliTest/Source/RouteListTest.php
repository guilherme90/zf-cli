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
        static::assertInternalType('array', $this->routeList->listRoutesFromModule($this->modulePath));
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
}