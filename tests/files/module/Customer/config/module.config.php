<?php

return [
    'service_manager' => [
        'factories' => [
            
        ],
    ],
    'controllers' => [
        'factories' => [
            'Customer\Controller\GetCustomerController' => 'Customer\Controller\Factory\GetCustomerControllerFactory',
            'Customer\Controller\AddCustomerController' => 'Customer\Controller\Factory\AddCustomerControllerFactory',
            'Customer\Controller\ListCustomersController' => 'Customer\Controller\Factory\ListCustomersControllerFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'get-customer' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/get-customer',
                    'defaults' => [
                        'controller' => 'Customer\Controller\GetCustomerController',
                        'action' => 'index',
                    ],
                ],
            ],
            'add-customer' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/add-customer',
                    'defaults' => [
                        'controller' => 'Customer\Controller\AddCustomerController',
                        'action' => 'index',
                    ],
                ],
            ],
            'list-customers' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/list-customers',
                    'defaults' => [
                        'controller' => 'Customer\Controller\ListCustomersController',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];