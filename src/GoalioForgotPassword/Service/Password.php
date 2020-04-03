<?php

namespace GoalioForgotPassword\Service;

use ZfcUser\Options\PasswordOptionsInterface;

use GoalioForgotPassword\Options\ForgotOptionsInterface;

use ZfcUser\Mapper\UserInterface as UserMapperInterface;
use GoalioForgotPassword\Mapper\Password as PasswordMapper;

use Laminas\Crypt\Password\Bcrypt;
use ZfcBase\EventManager\EventProvider;

class Password extends EventProvider
{
    /**
     * @var ModelMapper
     */
    protected $passwordMapper;
    protected $userMapper;
    protected $serviceLocator;
    protected $options;
    protected $zfcUserOptions;
    protected $emailRenderer;
    protected $mailservice;

    public function __construct($options, $passwordMapper, $userMapper, $mailservice, $zfcUserOptions)
    {
        $this->options = $options;
        $this->passwordMapper = $passwordMapper;
        $this->userMapper = $userMapper;
        $this->mailservice = $mailservice;
        $this->zfcUserOptions = $zfcUserOptions;
    }

    public function findByRequestKey($token)
    {
        return $this->getPasswordMapper()->findByRequestKey($token);
    }

    public function findByEmail($email)
    {
        return $this->getPasswordMapper()->findByEmail($email);
    }

    public function cleanExpiredForgotRequests()
    {
        $expireOption = $this->getOptions()->getResetExpire();
        return $this->getPasswordMapper()->cleanExpiredForgotRequests($expireOption);
    }

    public function cleanPriorForgotRequests($userId)
    {
        return $this->getPasswordMapper()->cleanPriorForgotRequests($userId);
    }

    public function remove($m)
    {
        return $this->getPasswordMapper()->remove($m);
    }

    public function sendProcessForgotRequest($userId, $email)
    {
        //Invalidate all prior request for a new password
        $this->cleanPriorForgotRequests($userId);

        $class = $this->getOptions()->getPasswordEntityClass();
        $model = new $class;
        $model->setUserId($userId);
        $model->setRequestTime(new \DateTime('now'));
        $model->generateRequestKey();
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('record' => $model, 'userId' => $userId));
        $this->getPasswordMapper()->persist($model);

        $this->sendForgotEmailMessage($email, $model);
    }

    public function sendForgotEmailMessage($to, $model)
    {
        $mailService = $this->mailservice;

        $from = $this->getOptions()->getEmailFromAddress();
        $subject = $this->getOptions()->getResetEmailSubjectLine();
        $template = $this->getOptions()->getResetEmailTemplate();

        $message = $mailService->createTextMessage($from, $to, $subject, $template, array('record' => $model));

        $mailService->send($message);
    }

    public function resetPassword($password, $user, array $data)
    {
        $newPass = $data['newCredential'];

        $bcrypt = new Bcrypt;
        $bcrypt->setCost($this->getZfcUserOptions()->getPasswordCost());

        $pass = $bcrypt->create($newPass);
        $user->setPassword($pass);

        $this->getEventManager()->trigger(__FUNCTION__, $this, array('user' => $user));
        $this->getUserMapper()->update($user);
        $this->remove($password);
        $this->getEventManager()->trigger(__FUNCTION__.'.post', $this, array('user' => $user));

        return true;
    }

    /**
     * getUserMapper
     *
     * @return UserMapperInterface
     */
    public function getUserMapper()
    {
        return $this->userMapper;
    }

    /**
     * setUserMapper
     *
     * @param UserMapperInterface $userMapper
     * @return User
     */
    public function setUserMapper(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
        return $this;
    }

    public function setPasswordMapper(PasswordMapper $passwordMapper)
    {
        $this->passwordMapper = $passwordMapper;
        return $this;
    }

    public function getPasswordMapper()
    {
        return $this->passwordMapper;
    }

    public function setMessageRenderer(ViewRenderer $emailRenderer)
    {
        $this->emailRenderer = $emailRenderer;
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions(ForgotOptionsInterface $opt)
    {
        $this->options = $opt;
        return $this;
    }

    public function getZfcUserOptions()
    {
        return $this->zfcUserOptions;
    }

    public function setZfcUserOptions(PasswordOptionsInterface $zfcUserOptions)
    {
        $this->zfcUserOptions = $zfcUserOptions;
        return $this;
    }
}
