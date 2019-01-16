<?php

namespace Payment\Controller\Factory;

use Payment\Controller\ListPaymentsController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListPaymentsControllerFactory implements FactoryInterface
{

    /**
     * @inheritdoc
     * 
     * @return ListPaymentsController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var $realServiceLocator \Zend\ServiceManager\ServiceManager */
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        return new ListPaymentsController();
    }


}

