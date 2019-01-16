<?php

namespace User;

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