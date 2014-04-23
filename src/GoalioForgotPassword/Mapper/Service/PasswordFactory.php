<?php
namespace GoalioForgotPassword\Mapper\Service;

use GoalioForgotPassword\Mapper\Password;
use GoalioForgotPassword\Mapper\PasswordHydrator;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class PasswordFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $options = $serviceLocator->get('goalioforgotpassword_module_options');
        $mapper = new Password();
        $mapper->setDbAdapter($serviceLocator->get('zfcuser_zend_db_adapter'));
        $entityClass = $options->getPasswordEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new PasswordHydrator());
        return $mapper;
    }

}