<?php

namespace ZFCli\Source;

use \Zend\Code\Generator;
use Zend\Code\Generator\ValueGenerator;
use ZFCli\DirectoryTrait;
use ZFCli\Source\Content\FileContentTrait;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>>
 */
class CreateController implements GenerateCodeInterface
{
    use FileContentTrait,
        DirectoryTrait,
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
     * @var string
     */
    private $actionName;

    /**
     * @var string
     */
    private $path;

    /**
     * @param string $modulePath
     * @param string $moduleName
     * @param string $controllerName
     * @param string $actionName
     */
    public function __construct(
        $modulePath,
        $moduleName,
        $controllerName,
        $actionName = null
    ) {
        $this->modulePath = $modulePath;
        $this->moduleName = trim(ucfirst($moduleName));
        $this->controllerName = trim(ucfirst($controllerName));
        $this->path = getcwd();

        if ($actionName) {
            $this->actionName = trim($actionName);
        }

    }

    /**
     * @return bool|int
     */
    private function addControllerNameInApplicationFile()
    {
        $configFile = $this->path . '/module/' . $this->moduleName . '/config/module.config.php';
        $moduleConfig = require $configFile;

        $routeName = $this->filterControllerName($this->controllerName);
        $moduleConfig['controllers']['factories']["{$this->moduleName}\Controller\\{$this->controllerName}"] = "{$this->moduleName}\Controller\Factory\\{$this->controllerName}Factory";

        $moduleConfig['router']['routes'][$routeName] = [
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => [
                'route' => '/' . $routeName,
                'defaults' => [
                    'controller' => "{$this->moduleName}\Controller\\{$this->controllerName}",
                    'action' => $this->actionName ?: 'index'
                ]
            ],
        ];

        $newContent = sprintf('%s', new ValueGenerator($moduleConfig, ValueGenerator::TYPE_ARRAY_SHORT));
        $output = stripcslashes($newContent);

        $contentFile = <<<CONTENT
<?php

return {$output};
CONTENT;

        return $this->putFileContent($configFile, $contentFile);
    }

    /**
     * @return bool|int
     */
    private function generateControllerClass()
    {
        $src = $this->generateMethodStructure(
            !$this->actionName ? 'index' : $this->actionName,
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
            ->setIndentation(4)
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
     * @return void
     */
    private function generateView()
    {
        if ($this->controllerName) {
            $moduleNameView = $this->filterModuleName($this->moduleName);
            $controllerNameView = $this->filterControllerName($this->controllerName);

            $this->createDirectory('module/' . $this->moduleName
                . '/view/' . $moduleNameView
                . '/' . $controllerNameView);

            $action = $this->actionName ?: 'index';

            $contentFile = <<<FILE
Module created! <br />

<h1>Module: {$this->moduleName} | Controller: {$this->controllerName} | Action: {$action}</h1>
FILE;

            $this->putFileContent("{$this->path}/module/{$this->moduleName}/view/{$moduleNameView}/{$controllerNameView}/{$action}.phtml", $contentFile);
        }
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $this->generateControllerClass();
        $this->generateControllerFactoryClass();
        $this->generateView();

        $this->addControllerNameInApplicationFile();
    }
}
