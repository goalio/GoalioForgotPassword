<?php
namespace GoalioForgotPassword\Options\Service;

use GoalioForgotPassword\Options\ModuleOptions;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\FactoryInterface;

class ModuleOptionsFactory implements FactoryInterface {

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = NULL) {
        $config = $container->get('Config');
        return new ModuleOptions(isset($config['goalioforgotpassword']) ? $config['goalioforgotpassword'] : array());
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $this->__invoke($serviceLocator,null);
    }

}
