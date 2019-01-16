<?php

namespace User\Controller\Factory;

use User\Controller\UsersListController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UsersListControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return UsersListController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new UsersListController();
    }


}

