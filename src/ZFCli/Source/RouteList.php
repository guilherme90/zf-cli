<?php

namespace ZFCli\Source;

/**
 * @author Guilherme Nogueira <guilhermenogueira90@gmail.com>
 */
class RouteList
{
    public function listRoutes()
    {

    }

    /**
     * @param string $modulePath
     * @return array
     * @throws \Exception
     */
    public function listRoutesFromModule($modulePath)
    {
        if (! is_dir($modulePath)) {
            throw new \Exception('Module not found.');
        }

        $moduleConfig = require "{$modulePath}/config/module.config.php";

        if (is_array($moduleConfig['router']['routes']) && count($moduleConfig['router']['routes']) > 0) {
            $routes = [];

            foreach ($moduleConfig['router']['routes'] as $item) {
                $options = $item['options'];
                $routes[] = [
                    $options['route'],
                    $item['type'],
                    $options['defaults']['controller'],
                    $options['defaults']['action']
                ];
            }

            return $routes;
        }

        return [];
    }
}