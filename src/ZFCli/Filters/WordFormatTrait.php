<?php

namespace ZFCli\Filters;

use Zend\Filter\Word\CamelCaseToDash;

/**
 * @author Guilherme P. Nogueira <guilhermenogueira90@gmail.com>
 */
trait WordFormatTrait
{
    /**
     * @param string $moduleName
     *
     * @return string
     */
    public function filterModuleName($moduleName)
    {
        $filter = new CamelCaseToDash();

        return strtolower($filter->filter($moduleName));
    }

    /**
     * @param string $controllerName
     *
     * @return string
     */
    public function filterControllerName($controllerName)
    {
        $camelCaseToDash = new CamelCaseToDash();
        $words = explode('-', strtolower($camelCaseToDash->filter($controllerName)));

        $newControllerName = array_filter($words, function ($word) {
            return $word !== 'controller';
        });

        return implode('-', $newControllerName);
    }
}
