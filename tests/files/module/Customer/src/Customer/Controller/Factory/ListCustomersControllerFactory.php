<?php

namespace Customer\Controller\Factory;

use Customer\Controller\ListCustomersController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListCustomersControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return ListCustomersController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new ListCustomersController();
    }


}

