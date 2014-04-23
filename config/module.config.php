<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'goalioforgotpassword' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'zfc-user/user/login' => __DIR__ . '/../view/zfc-user/user/login.phtml',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'goalioforgotpassword_forgot' => 'GoalioForgotPassword\Controller\ForgotController',
        ),
    ),

    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'zfcuser' => array(
                'child_routes' => array(
                    'forgotpassword' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/forgot-password',
                            'defaults' => array(
                                'controller' => 'goalioforgotpassword_forgot',
                                'action'     => 'forgot',
                            ),
                        ),
                    ),
                    'resetpassword' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/reset-password/:userId/:token',
                            'defaults' => array(
                                'controller' => 'goalioforgotpassword_forgot',
                                'action'     => 'reset',
                            ),
                            'constraints' => array(
                                'userId'  => '[A-Fa-f0-9]+',
                                'token' => '[A-F0-9]+',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
