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
     * @param $modulePath
     * @param $moduleName
     * @param $controllerName
     * @param $actionName
     */
    public function __construct(
        $modulePath,
        $moduleName,
        $controllerName,
        $actionName
    ) {
        $this->modulePath = $modulePath;
        $this->moduleName = trim(ucfirst($moduleName));
        $this->controllerName = trim(ucfirst($controllerName));
        $this->actionName = trim($actionName);
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
}