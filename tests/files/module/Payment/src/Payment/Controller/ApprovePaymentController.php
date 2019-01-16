<?php

namespace Payment\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ModelInterface;

class ApprovePaymentController extends AbstractActionController
{

    /**
     * @return ModelInterface
     */
    public function indexAction()
    {
        return (new ViewModel())
            ->setTemplate('payment/approve-payment/index')
            ->setVariables([
                
            ]);
    }


}

