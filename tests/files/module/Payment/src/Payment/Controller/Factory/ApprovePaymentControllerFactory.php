<?php

namespace Payment\Controller\Factory;

use Payment\Controller\ApprovePaymentController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApprovePaymentControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return ApprovePaymentController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new ApprovePaymentController();
    }


}

