<?php

namespace GoalioForgotPasswordTest\Util;

use Laminas\ServiceManager\ServiceManager;
use Laminas\Mvc\Service\ServiceManagerConfig;

class ServiceManagerFactory
{
    /**
     * @var array
     */
    protected static $config;

    /**
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        static::$config = $config;
    }

    /**
     * Builds a new service manager
     */
    public static function getServiceManager()
    {
        $serviceManager = new ServiceManager(new ServiceManagerConfig(
            isset(static::$config['service_manager']) ? static::$config['service_manager'] : array()
        ));
        $serviceManager->setService('ApplicationConfig', static::$config);
        $serviceManager->setFactory('ServiceListener', 'Laminas\Mvc\Service\ServiceListenerFactory');

        /** @var $moduleManager \Laminas\ModuleManager\ModuleManager */
        $moduleManager = $serviceManager->get('ModuleManager');
        $moduleManager->loadModules();
        //$serviceManager->setAllowOverride(true);
        return $serviceManager;
    }
}