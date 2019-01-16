<?php

namespace Payment\Controller\Factory;

use Payment\Controller\ProcessPaymentController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProcessPaymentControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return ProcessPaymentController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new ProcessPaymentController();
    }


}

