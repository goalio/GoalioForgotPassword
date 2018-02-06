<?php
namespace GoalioForgotPassword;

use Zend\Loader\StandardAutoloader;
use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\ModuleRouteListener;

class Module {

    public function getAutoloaderConfig() {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getModuleDependencies() {
        return array('ZfcUser', 'ZfcBase');
    }

    public function getServiceConfig() {
        return array(
            'invokables' => array(
                
            ),

            'factories' => array(
                'goalioforgotpassword_module_options'  => 'GoalioForgotPassword\Options\Service\ModuleOptionsFactory',
                'goalioforgotpassword_forgot_form'     => 'GoalioForgotPassword\Form\Service\ForgotFactory',
                'goalioforgotpassword_reset_form'      => 'GoalioForgotPassword\Form\Service\ResetFactory',
                'goalioforgotpassword_password_mapper' => 'GoalioForgotPassword\Mapper\Service\PasswordFactory',
                'goalioforgotpassword_password_service'  => 'GoalioForgotPassword\Factory\Service\PasswordFactory',
            ),
        );
    }
}

