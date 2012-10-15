<?php

namespace GoalioForgotPassword\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements
    ForgotOptionsInterface
{
    /**
     * @var string
     */
    protected $emailFromAddress = '';

    /**
     * @var string
     */
    protected $resetEmailSubjectLine = 'You requested to reset your password';

    /**
     * @var string
     */
    protected $emailTransport = 'Zend\Mail\Transport\Sendmail';

    /**
     * @var string
     */
    protected $passwordEntityClass = 'GoalioForgotPassword\Entity\Password';

    /**
     * @var int
     */
    protected $resetExpire = 86400;


    public function getEmailFromAddress() {
        return $this->emailFromAddress;
    }

	public function getResetEmailSubjectLine() {
        return $this->resetEmailSubjectLine;
    }

	public function getEmailTransport() {
        return $this->emailTransport;
    }

	public function setEmailFromAddress($emailFromAddress) {
        $this->emailFromAddress = $emailFromAddress;
        return $this;
    }

	public function setResetEmailSubjectLine($resetEmailSubjectLine) {
        $this->resetEmailSubjectLine = $resetEmailSubjectLine;
        return $this;
    }

	public function setEmailTransport($emailTransport) {
        $this->emailTransport = $emailTransport;
        return $this;
    }

	/**
     * set user entity class name
     *
     * @param string $userEntityClass
     * @return ModuleOptions
     */
    public function setPasswordEntityClass($passwordEntityClass)
    {
        $this->passwordEntityClass = $passwordEntityClass;
        return $this;
    }

    /**
     * get user entity class name
     *
     * @return string
     */
    public function getPasswordEntityClass()
    {
        return $this->passwordEntityClass;
    }

	public function setResetExpire($resetExpire) {
        $this->resetExpire = $resetExpire;
        return $this;
    }

	public function getResetExpire() {
        return $this->resetExpire;
    }
}
