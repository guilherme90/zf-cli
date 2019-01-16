<?php

namespace ZFCliTest\Source;

use \Zend\Code\Generator;
use PHPUnit\Framework\TestCase;
use Zend\Code\Generator\ClassGenerator;
use ZFCli\Source\GenerateStructureTrait;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class GenerateStructureTraitTest extends TestCase
{
    use GenerateStructureTrait;

    /**
     * @test
     */
    public function checkClassStructure()
    {
        $class = $this->generateClassStructure('UserController', 'User');
        static::assertInstanceOf(ClassGenerator::class, $class);

        $body = <<<BODY
            return (new ViewModel())
    ->setTemplate('user/user/index')
    ->setVariables([
        
    ]);
BODY;

        $method = new Generator\MethodGenerator();
        $method
            ->setFlags(Generator\MethodGenerator::FLAG_PUBLIC)
            ->setName('listUsersAction')
            ->setDocBlock('@return ModelInterface')
            ->setBody($body);

        $class = $this->generateClassStructure('UserController', 'User')
            ->addMethodFromGenerator($method);

        $file = new Generator\FileGenerator();
        $file->setClass($class);

        static::assertIsString( $file->generate());
    }
}