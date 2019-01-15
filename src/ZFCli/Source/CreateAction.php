<?php

namespace ZFCli\Source;

use ZFCli\Source\Content\FileContentTrait;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class CreateAction implements GenerateCodeInterface
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
     * @var string
     */
    private $actionName;

    /**
     * @param string $modulePath
     * @param string $moduleName
     * @param string $controllerName
     * @param string $actionName
     */
    public function __construct(
        $modulePath = null,
        $moduleName = null,
        $controllerName = null,
        $actionName = null
    ) {
        $this->modulePath = $modulePath;
        $this->moduleName = trim(ucfirst($moduleName));
        $this->controllerName = trim(ucfirst($controllerName));
        $this->actionName = trim(lcfirst($actionName));
    }

    /**
     * @return bool|int
     */
    private function actionMethod()
    {
        $src = $this->generateMethodStructure(
            $this->actionName ?: 'index',
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
     * @return mixed|void
     */
    public function generate()
    {
        $this->actionMethod();
    }

    /**
     * @return bool|int
     * @throws \ReflectionException
     */
    public function generateNewActionMethod()
    {
        require_once getcwd() . "/module/{$this->moduleName}/src/{$this->moduleName}/Controller/$this->controllerName.php";

        $src = $this->appendClassMethod("\\{$this->moduleName}\Controller\\{$this->controllerName}", $this->actionName);

        return $this->putFileContent(
            $this->modulePath . '/'
            . $this->moduleName . '/src/'
            . $this->moduleName . '/Controller/'
            . $this->controllerName . '.php',
            $src
        );
    }
}