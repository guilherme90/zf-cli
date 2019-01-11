<?php

namespace ZFCli\Source;

use \Zend\Code\Generator;
use ZFCli\Filters\WordFormatTrait;

/**
 * @author Guilherme Nogueira <guilhermenogueira2univicosa.com.br>
 */
trait GenerateStructureTrait
{
    use WordFormatTrait;

    /**
     * @param $methodName
     * @param $controllerName
     * @param $moduleName
     * @return string
     */
    public function generateMethodStructure($methodName, $controllerName, $moduleName)
    {
        $moduleNameView = $this->filterModuleName($moduleName);
        $controllerNameView = $this->filterControllerName($controllerName);

        $body = <<<BODY
            return (new ViewModel())
    ->setTemplate('{$moduleNameView}/{$controllerNameView}/index')
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
     * @param $className
     * @param $moduleName
     * @return Generator\ClassGenerator
     */
    public function generateClassStructure($className, $moduleName)
    {
        $class = new Generator\ClassGenerator();
        $class->setNamespaceName($moduleName . '\\Controller')
            ->setName($className)
            ->setExtendedClass('AbstractActionController')
            ->addUse('Zend\Mvc\Controller\AbstractActionController')
            ->addUse('Zend\View\Model\ViewModel')
            ->addUse('Zend\View\Model\JsonModel')
            ->addUse('Zend\View\Model\ModelInterface');

        return $class;
    }

}