<?php

namespace User\Controller\Factory;

use User\Controller\GetUserController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GetUserControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return GetUserController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new GetUserController();
    }


}

