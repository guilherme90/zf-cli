<?php

namespace Customer\Controller\Factory;

use Customer\Controller\GetCustomerController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GetCustomerControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return GetCustomerController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new GetCustomerController();
    }


}

