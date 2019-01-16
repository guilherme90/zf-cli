<?php

namespace User\Controller\Factory;

use User\Controller\RemoveUserController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RemoveUserControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return RemoveUserController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new RemoveUserController();
    }


}

