<?php

namespace GoalioForgotPassword\Form;

use Laminas\InputFilter\InputFilter;
use GoalioForgotPassword\Options\ForgotOptionsInterface;

class ResetFilter extends InputFilter
{
    protected $passwordValidator;
    public function __construct(ForgotOptionsInterface $options, $passwordValidator, $config)
    {
        $this->passwordValidator = $passwordValidator;
        $this->add(array(
            'name'       => 'newCredential',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => $config['minPasswordLength'],
                    ),
                ),
                $this->passwordValidator,
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));

        $this->add(array(
            'name'       => 'newCredentialVerify',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'min' => $config['minPasswordLength'],
                    ),
                ),
                array(
                    'name' => 'identical',
                    'options' => array(
                        'token' => 'newCredential'
                    )
                ),
                $this->passwordValidator,
            ),
            'filters'   => array(
                array('name' => 'StringTrim'),
            ),
        ));

    }
}
