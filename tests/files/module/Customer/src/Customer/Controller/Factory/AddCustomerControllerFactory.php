<?php

namespace Customer\Controller\Factory;

use Customer\Controller\AddCustomerController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AddCustomerControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return AddCustomerController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new AddCustomerController();
    }


}

