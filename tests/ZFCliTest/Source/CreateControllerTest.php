<?php

namespace ZFCliTest\Source;

use PHPUnit\Framework\TestCase;
use ZFCli\DirectoryTrait;
use ZFCli\Source\CreateController;
use ZFCli\Source\GenerateCodeInterface;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
class CreateControllerTest extends TestCase
{
    use DirectoryTrait;

    /**
     * @var CreateController
     */
    private $createController;

    public function setUp()
    {
        parent::setUp();

        $this->createController = new CreateController(
            getcwd() . '/module',
            'User',
            'ListUsersController'
        );

        $this->createDirectory('module');
        $this->createDirectory('module/User');
        $this->createDirectory('module/User/src');
        $this->createDirectory('module/User/src/User');
        $this->createDirectory('module/User/src/User/Controller');
        $this->createDirectory('module/User/src/User/Controller/Factory');
    }

    /**
     * @test
     */
    public function instanceOfGenerateCodeInterface()
    {
        static::assertInstanceOf(GenerateCodeInterface::class, $this->createController);
    }

    /**
     * @test
     */
    public function generateControllerClass()
    {
        $reflection = new \ReflectionClass(CreateController::class);
        $method = $reflection->getMethod('generateControllerClass');
        $method->setAccessible(true);

        static::assertInternalType('int', $method->invoke($this->createController));
    }

    /**
     * @test
     */
    public function generateControllerFactoryClass()
    {
        $reflection = new \ReflectionClass(CreateController::class);
        $method = $reflection->getMethod('generateControllerFactoryClass');
        $method->setAccessible(true);

        static::assertInternalType('int', $method->invoke($this->createController));
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->removeDirectoryRecursive(getcwd() . '/module');
    }
}
