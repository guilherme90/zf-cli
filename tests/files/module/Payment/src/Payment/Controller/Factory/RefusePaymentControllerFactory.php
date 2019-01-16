<?php

namespace Payment\Controller\Factory;

use Payment\Controller\RefusePaymentController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RefusePaymentControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return RefusePaymentController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new RefusePaymentController();
    }


}

