<?php

namespace ZFCli\Source;

use \Zend\Code\Generator;
use ZFCli\Filters\WordFormatTrait;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
trait GenerateStructureTrait
{
    use WordFormatTrait;

    /**
     * @param string $methodName
     * @param string $controllerName
     * @param string $moduleName
     * @return string
     */
    public function generateMethodStructure(
        $methodName,
        $controllerName,
        $moduleName
    ) {
        $moduleNameView = $this->filterModuleName($moduleName);
        $controllerNameView = $this->filterControllerName($controllerName);

        $body = <<<BODY
            return (new ViewModel())
    ->setTemplate('{$moduleNameView}/{$controllerNameView}/{$methodName}')
    ->setVariables([
        
    ]);
BODY;

        $method = new Generator\MethodGenerator();
        $method
            ->setFlags(Generator\MethodGenerator::FLAG_PUBLIC)
            ->setName($methodName . 'Action')
            ->setDocBlock('@return ModelInterface')
            ->setBody($body);

        $class = $this->generateClassStructure($controllerName, $moduleName)
            ->addMethodFromGenerator($method);

        $file = new Generator\FileGenerator();
        $file->setClass($class);

        return $file->generate();
    }

    /**
     * @param string $className
     * @param string $moduleName
     * @return Generator\ClassGenerator
     */
    public function generateClassStructure($className, $moduleName)
    {
        $class = new Generator\ClassGenerator();
        $class->setNamespaceName($moduleName . '\\Controller')
            ->setName($className)
            ->setIndentation(4)
            ->setExtendedClass('AbstractActionController')
            ->addUse('Zend\Mvc\Controller\AbstractActionController')
            ->addUse('Zend\View\Model\ViewModel')
            ->addUse('Zend\View\Model\JsonModel')
            ->addUse('Zend\View\Model\ModelInterface');

        return $class;
    }

    /**
     * @param string $class
     * @param string $methodName
     * @return string
     * @throws \ReflectionException
     */
    public function appendClassMethod($class, $methodName)
    {
        $class = Generator\ClassGenerator::fromReflection(
            new \Zend\Code\Reflection\ClassReflection($class)
        );

        $method = new Generator\MethodGenerator();
        $method
            ->setFlags(Generator\MethodGenerator::FLAG_PUBLIC)
            ->setName($methodName . 'Action')
            ->setDocBlock('@return ModelInterface');

        $class
            ->addUse('Zend\Mvc\Controller\AbstractActionController')
            ->addUse('Zend\View\Model\ViewModel')
            ->addUse('Zend\View\Model\JsonModel')
            ->addUse('Zend\View\Model\ModelInterface')
            ->setExtendedClass('AbstractActionController')
            ->addMethodFromGenerator($method);

        $file = new Generator\FileGenerator();
        $file->setClass($class);

        return $file->generate();
    }
}