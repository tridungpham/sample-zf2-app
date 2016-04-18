<?php

return [
    'controllers' => [
        'invokables' => [
//            'App\Controller\Course' => 'App\Controller\CourseController'
        ],
        'factories' => [
            'App\Controller\Course' => 'App\Factory\CourseControllerFactory',
            'App\Controller\Students' => 'App\Factory\StudentsControllerFactory',
            'App\Controller\Student' => 'App\Factory\StudentControllerFactory',
        ]
    ],

    'router' => [
        'routes' => [
            'course' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/course[/:action][/:id]',
                    'constrains' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'App\Controller\Course',
                        'action' => 'index'
                    ]
                ]
            ],
            'students' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/students[/:action][/:id]',
                    'constrains' => [
                        'action' => 'list',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'App\Controller\Students',
                        'action' => 'index'
                    ]
                ]
            ],
            'student' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/student[/:action][/:id]',
                    'constrains' => [
                        'action' => 'create|edit|view|delete|save',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => 'App\Controller\Student',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => dirname(__DIR__) . '/view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
];