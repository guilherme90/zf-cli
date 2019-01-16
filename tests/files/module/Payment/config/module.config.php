<?php

return [
    'service_manager' => [
        'factories' => [
            
        ],
    ],
    'controllers' => [
        'factories' => [
            'Payment\Controller\ProcessPaymentController' => 'Payment\Controller\Factory\ProcessPaymentControllerFactory',
            'Payment\Controller\ListPaymentsController' => 'Payment\Controller\Factory\ListPaymentsControllerFactory',
            'Payment\Controller\ApprovePaymentController' => 'Payment\Controller\Factory\ApprovePaymentControllerFactory',
            'Payment\Controller\RefusePaymentController' => 'Payment\Controller\Factory\RefusePaymentControllerFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'process-payment' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/process-payment',
                    'defaults' => [
                        'controller' => 'Payment\Controller\ProcessPaymentController',
                        'action' => 'index',
                    ],
                ],
            ],
            'list-payments' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/list-payments',
                    'defaults' => [
                        'controller' => 'Payment\Controller\ListPaymentsController',
                        'action' => 'index',
                    ],
                ],
            ],
            'approve-payment' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/approve-payment',
                    'defaults' => [
                        'controller' => 'Payment\Controller\ApprovePaymentController',
                        'action' => 'index',
                    ],
                ],
            ],
            'refuse-payment' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/refuse-payment',
                    'defaults' => [
                        'controller' => 'Payment\Controller\RefusePaymentController',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];