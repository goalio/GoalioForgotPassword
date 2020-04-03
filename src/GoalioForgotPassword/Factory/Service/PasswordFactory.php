<?php

namespace GoalioForgotPassword\Factory\Service;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;
use GoalioForgotPassword\Service\Password;

/**
 * Description of UserControllerFactory
 *
 * @author prautmanis
 */
class PasswordFactory implements FactoryInterface{
        
    public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL) {
        $controller = new Password(
                $container->get('goalioforgotpassword_module_options'),
                $container->get('goalioforgotpassword_password_mapper'),
                $container->get('zfcuser_user_mapper'),
                $container->get('goaliomailservice_message'),
                $container->get('zfcuser_module_options')
                );

        return $controller;
    }
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $this->__invoke($serviceLocator,null);
    }
}
