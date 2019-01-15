<?php

return [
    'service_manager' => [
        'factories' => [
            
        ],
    ],
    'controllers' => [
        'factories' => [
            'User\Controller\ListUsersController' => 'User\Controller\Factory\ListUsersControllerFactory',
            'User\Controller\GetUserController' => 'User\Controller\Factory\GetUserControllerFactory',
            'User\Controller\AddNewUserController' => 'User\Controller\Factory\AddNewUserControllerFactory',
            'User\Controller\UpdateUserController' => 'User\Controller\Factory\UpdateUserControllerFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'list-users' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/list-users',
                    'defaults' => [
                        'controller' => 'User\Controller\ListUsersController',
                        'action' => 'index',
                    ],
                ],
            ],
            'get-user' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/get-user',
                    'defaults' => [
                        'controller' => 'User\Controller\GetUserController',
                        'action' => 'index',
                    ],
                ],
            ],
            'add-new-user' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/add-new-user',
                    'defaults' => [
                        'controller' => 'User\Controller\AddNewUserController',
                        'action' => 'index',
                    ],
                ],
            ],
            'update-user' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/update-user',
                    'defaults' => [
                        'controller' => 'User\Controller\UpdateUserController',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];