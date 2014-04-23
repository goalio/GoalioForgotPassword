<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'goalioforgotpassword_password_service'            => 'GoalioForgotPassword\Service\Password',
        ),
        'factories' => array(
            'goalioforgotpassword_module_options'  => 'GoalioForgotPassword\Options\Service\ModuleOptionsFactory',
            'goalioforgotpassword_forgot_form'     => 'GoalioForgotPassword\Form\Service\ForgotFactory',
            'goalioforgotpassword_reset_form'      => 'GoalioForgotPassword\Form\Service\ResetFactory',
            'goalioforgotpassword_password_mapper' => 'GoalioForgotPassword\Mapper\Service\PasswordFactory',
        ),
    ),
);