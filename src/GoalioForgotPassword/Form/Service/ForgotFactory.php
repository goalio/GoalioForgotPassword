<?php
namespace GoalioForgotPassword\Form\Service;

use GoalioForgotPassword\Form\Forgot;
use GoalioForgotPassword\Form\ForgotFilter;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\FactoryInterface;

class ForgotFactory implements FactoryInterface {

    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedName, array $options = NULL) {
        $options = $container->get('goalioforgotpassword_module_options');
        $form = new Forgot(null, $options);
        $validator = new \ZfcUser\Validator\RecordExists(array(
            'mapper' => $container->get('zfcuser_user_mapper'),
            'key'    => 'email'
        ));

        $translator = $container->get('MvcTranslator');

        $validator->setMessage($translator->translate('The email address you entered was not found.'));
        $form->setInputFilter(new ForgotFilter($validator,$options));
        return $form;
    }

    public function createService(ServiceLocatorInterface $serviceLocator) {
        return $this->__invoke($serviceLocator,null);
    }

}
