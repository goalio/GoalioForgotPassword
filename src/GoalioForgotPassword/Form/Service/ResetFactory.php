<?php
namespace GoalioForgotPassword\Form\Service;

use GoalioForgotPassword\Form\Reset;
use GoalioForgotPassword\Form\ResetFilter;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\FactoryInterface;

class ResetFactory implements FactoryInterface {

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = NULL) {
        $options = $container->get('goalioforgotpassword_module_options');
        $form = new Reset(null, $options);
        $form->setInputFilter(new ResetFilter($options));
        return $form;
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $this->__invoke($serviceLocator,null);
    }

}
