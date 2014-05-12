<?php
namespace GoalioForgotPassword\Form\Service;

use GoalioForgotPassword\Form\Reset;
use GoalioForgotPassword\Form\ResetFilter;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class ResetFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $options = $serviceLocator->get('goalioforgotpassword_module_options');
        $form = new Reset(null, $options);
        $form->setInputFilter(new ResetFilter($options));
        return $form;
    }

}
