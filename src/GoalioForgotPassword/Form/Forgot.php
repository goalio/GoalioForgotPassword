<?php

namespace GoalioForgotPassword\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;
use GoalioForgotPassword\Options\ForgotOptionsInterface;

class Forgot extends Form
{
    /**
     * @var AuthenticationOptionsInterface
     */
    protected $forgotOptions;

    public function __construct($name = null, ForgotOptionsInterface $options)
    {
        $this->setForgotOptions($options);
        parent::__construct($name);

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Request new password')
            ->setAttributes(array(
                'type'  => 'submit',
            ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

    }

    public function setForgotOptions(ForgotOptionsInterface $forgotOptions)
    {
        $this->forgotOptions = $forgotOptions;
        return $this;
    }

    public function getForgotOptions()
    {
        return $this->forgotOptions;
    }
}
