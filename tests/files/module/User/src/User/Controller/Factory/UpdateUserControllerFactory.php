<?php

namespace User\Controller\Factory;

use User\Controller\UpdateUserController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UpdateUserControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return UpdateUserController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new UpdateUserController();
    }


}

