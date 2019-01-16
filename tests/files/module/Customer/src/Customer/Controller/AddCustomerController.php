<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ModelInterface;

class AddCustomerController extends AbstractActionController
{

    /**
     * @return ModelInterface
     */
    public function indexAction()
    {
        return (new ViewModel())
            ->setTemplate('customer/add-customer/index')
            ->setVariables([
                
            ]);
    }


}

