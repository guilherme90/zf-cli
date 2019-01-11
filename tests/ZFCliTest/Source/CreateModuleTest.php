<?php

namespace ZFCliTest\Source;

use PHPUnit\Framework\TestCase;
use ZFCli\Source\CreateModule;
use ZFCli\Source\GenerateCodeInterface;

class CreateModuleTest extends TestCase
{
    /**
     * @var CreateModule
     */
    private $createModule;

    public function setUp()
    {
        parent::setUp();

        $this->createModule = new CreateModule('CreditCard');
    }

    /**
     * @test
     */
    public function instanceOfGenerateCodeInterface()
    {
        static::assertInstanceOf(GenerateCodeInterface::class, $this->createModule);
    }
}
