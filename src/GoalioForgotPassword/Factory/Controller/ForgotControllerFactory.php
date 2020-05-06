<?php

namespace GoalioForgotPassword\Factory\Controller;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use \Interop\Container\ContainerInterface;
use GoalioForgotPassword\Controller\ForgotController;

/**
 * Description of UserControllerFactory
 *
 * @author prautmanis
 */
class ForgotControllerFactory implements FactoryInterface{
        
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        
        $controller = new ForgotController(
                $container->get('goalioforgotpassword_password_service'),
                $container->get('goalioforgotpassword_forgot_form'),
                $container->get('goalioforgotpassword_reset_form'),
                $container->get('zfcuser_user_service'),
                $container->get('goalioforgotpassword_module_options'),
                $container->get('zfcuser_module_options')
                );

        return $controller;
    }
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $this->__invoke($serviceLocator,null);
    }
}
