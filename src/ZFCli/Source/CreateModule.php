<?php

namespace ZFCli\Source;

use ZFCli\DirectoryTrait;
use ZFCli\Filters\WordFormatTrait;
use ZFCli\Source\Content\FileContentTrait;
use Zend\Code\Generator\ValueGenerator;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>>
 */
class CreateModule implements GenerateCodeInterface
{
    use FileContentTrait,
        WordFormatTrait,
        DirectoryTrait;

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
     * @param string      $moduleName
     * @param null|string $controllerName
     * @param null|string $actionName
     */
    public function __construct(
        $moduleName,
        $controllerName = null,
        $actionName = null
    ) {
        $this->moduleName = trim(ucfirst($moduleName));
        $this->controllerName = trim(ucfirst($controllerName));
        $this->actionName = trim(lcfirst($actionName));
        $this->path = getcwd();
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $this->isFile($this->path . '/config/application.config.php');
        $this->moduleExists($this->path . '/module/' . $this->moduleName);

        $moduleNameView = $this->filterModuleName($this->moduleName);

        /**
         * create directories
         */
        $this->createDirectory('module');
        $this->createDirectory('module/' . $this->moduleName);
        $this->createDirectory('module/' . $this->moduleName . '/config');
        $this->createDirectory('module/' . $this->moduleName . '/src/' . $this->moduleName . '/Controller');
        $this->createDirectory('module/' . $this->moduleName . '/src/' . $this->moduleName . '/Controller/Factory');
        $this->createDirectory('module/' . $this->moduleName . '/view/' . $moduleNameView);

        if ($this->controllerName) {
            $controllerNameView = $this->filterControllerName($this->controllerName);

            $this->createDirectory('module/' . $this->moduleName
                . '/view/' . $moduleNameView
                . '/' . $controllerNameView);
        }

        /**
         * create files
         */
        $this->createModuleConfig();
        $this->createModuleClass();

        /**
         * add module inside application.config.php
         */
        $this->addModuleNameInApplicationFile();
    }

    /**
     * @return bool|int
     */
    private function addModuleNameInApplicationFile()
    {
        $applicationFile = $this->path . '/config/application.config.php';
        $application = require $applicationFile;

        if (! in_array($this->moduleName, $application['modules'])) {
            $file = $this->path . '/config/application.config.php';

            $application['modules'][] = $this->moduleName;
            copy($file, $this->path . '/config/application.config.php.old');

            $newContent = sprintf('%s', new ValueGenerator($application, ValueGenerator::TYPE_ARRAY_SHORT));

            $contentFile = <<<CONTENT
<?php

return {$newContent};
CONTENT;

            return $this->putFileContent($applicationFile, $contentFile);
        }

        return false;
    }

    /**
     * @return bool|int
     */
    private function createModuleConfig()
    {
        $file = $this->path . '/module/' . $this->moduleName . '/config/module.config.php';

        if ($this->controllerName) {
            $routeName = $this->filterControllerName($this->controllerName);
            $action = $this->actionName ?: 'index';

            $contentFile = <<<FILE
<?php

use {$this->moduleName}\\Controller\\{$this->controllerName};
use {$this->moduleName}\\Controller\Factory\\{$this->controllerName}Factory;   
use \Zend\Mvc\Router\Http\Literal;
use \Zend\Mvc\Router\Http\Segment;

return [
    'controller_plugins' => [
        'factories' => [
            
        ]
    ],
    'view_helpers' => [
        'factories' => [
            
        ]
    ],
    'service_manager' => [
        'factories' => [

        ]
    ],
    'controllers' => [
        'factories' => [
            '{$this->moduleName}\\Controller\\{$this->controllerName}' => '{$this->moduleName}\\Controller\Factory\\{$this->controllerName}Factory'
        ]
    ],
    'router' => [
        'routes' => [
            '{$routeName}' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/{$routeName}',
                    'defaults' => [
                        'controller' => '{$this->moduleName}\\Controller\\{$this->controllerName}',
                        'action' => '{$action}'
                    ]
                ],
            ]
        ]
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]
];
FILE;

            return $this->putFileContent($file, $contentFile);
        }

        $contentFile = <<<FILE
<?php
   
use \Zend\Mvc\Router\Http\Literal;
use \Zend\Mvc\Router\Http\Segment;

return [
    'service_manager' => [
        'factories' => [

        ]
    ],
    'controllers' => [
        'factories' => [
            
        ]
    ],
    'router' => [
        'routes' => [
        
        ]
    ],
];
FILE;

        return $this->putFileContent($file, $contentFile);
    }

    /**
     * @return bool|int
     */
    private function createModuleClass()
    {
        $contentFile = <<<FILE
<?php

namespace {$this->moduleName};

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getConfig()
    {
        return array_merge_recursive(
            require __DIR__ . '/config/module.config.php'
        );
    }
}
FILE;

        return $this->putFileContent($this->path . '/module/' . $this->moduleName . '/Module.php', $contentFile);
    }
}
