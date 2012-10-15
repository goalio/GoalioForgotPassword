<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'goalioforgotpassword' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'goalioforgotpassword_forgot' => 'GoalioForgotPassword\Controller\ForgotController',
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
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
                                'userId'  => '[0-9]+',
                                'token' => '[A-F0-9]+',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
