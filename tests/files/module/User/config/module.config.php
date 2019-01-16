<?php

return [
    'service_manager' => [
        'factories' => [
            
        ],
    ],
    'controllers' => [
        'factories' => [
            'User\Controller\UsersListController' => 'User\Controller\Factory\UsersListControllerFactory',
            'User\Controller\UpdateUserController' => 'User\Controller\Factory\UpdateUserControllerFactory',
            'User\Controller\GetUserController' => 'User\Controller\Factory\GetUserControllerFactory',
            'User\Controller\RemoveUserController' => 'User\Controller\Factory\RemoveUserControllerFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'users-list' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/users-list',
                    'defaults' => [
                        'controller' => 'User\Controller\UsersListController',
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
            'remove-user' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route' => '/remove-user',
                    'defaults' => [
                        'controller' => 'User\Controller\RemoveUserController',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];