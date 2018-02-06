<?php
namespace GoalioForgotPassword\Mapper\Service;

use GoalioForgotPassword\Mapper\Password;
use GoalioForgotPassword\Mapper\PasswordHydrator;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;

class PasswordFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = NULL) {
        $options = $container->get('goalioforgotpassword_module_options');
        $mapper = new Password();
        $mapper->setDbAdapter($container->get('zfcuser_zend_db_adapter'));
        $entityClass = $options->getPasswordEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new PasswordHydrator());
        return $mapper;
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $this->__invoke($serviceLocator,null);
    }

}
