<?php

namespace ZFCli\Source;

use \Zend\Code\Generator;
use ZFCli\Source\Content\FileContentTrait;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira@univicosa.com.br>
 */
class CreateController implements GenerateCodeInterface
{
    use FileContentTrait,
        GenerateStructureTrait;

    /**
     * @var string
     */
    private $modulePath;

    /**
     * @var string
     */
    private $moduleName;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @param string $modulePath
     * @param string $moduleName
     * @param string $controllerName
     */
    public function __construct(
        $modulePath,
        $moduleName,
        $controllerName
    ) {
        $this->modulePath = $modulePath;
        $this->moduleName = trim(ucfirst($moduleName));
        $this->controllerName = trim(ucfirst($controllerName));
    }

    /**
     * @return bool|int
     */
    private function generateControllerClass()
    {
        $src = $this->generateMethodStructure(
            'indexAction',
            $this->controllerName,
            $this->moduleName
        );

        return $this->putFileContent(
            $this->modulePath . '/'
                . $this->moduleName . '/src/'
                . $this->moduleName . '/Controller/'
                . $this->controllerName . '.php',
            $src
        );
    }

    /**
     * @return bool|int
     */
    private function generateControllerFactoryClass()
    {
        $body = <<<BODY
/** @var \$realServiceLocator \Zend\ServiceManager\ServiceManager */
\$realServiceLocator = \$serviceLocator->getServiceLocator();

return new {$this->controllerName}();
BODY;

        $dockBlock = <<<DOCBLOCK
@inheritdoc

@return {$this->controllerName}
DOCBLOCK;

        $parameterGenerator = new Generator\ParameterGenerator();
        $parameterGenerator
            ->setName('serviceLocator')
            ->setType('ServiceLocatorInterface');

        $method = new Generator\MethodGenerator();
        $method->setFlags(Generator\MethodGenerator::FLAG_PUBLIC)
            ->setName('createService')
            ->setDocBlock($dockBlock)
            ->setParameter($parameterGenerator)
            ->setBody($body);

        $class = new Generator\ClassGenerator();
        $class->setNamespaceName($this->moduleName . '\\Controller\\Factory')
            ->setName($this->controllerName . 'Factory')
            ->setImplementedInterfaces(['FactoryInterface'])
            ->addUse($this->moduleName . '\\Controller\\' . $this->controllerName)
            ->addUse('Zend\ServiceManager\FactoryInterface')
            ->addUse('Zend\ServiceManager\ServiceLocatorInterface')
            ->addMethodFromGenerator($method);

        $file = new Generator\FileGenerator();
        $file->setClass($class);

        return $this->putFileContent(
            $this->modulePath . '/'
                . $this->moduleName . '/src/'
                . $this->moduleName . '/Controller/Factory/'
                . $this->controllerName . 'Factory.php',
            $file->generate()
        );
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $this->generateControllerClass();
        $this->generateControllerFactoryClass();
    }
}
