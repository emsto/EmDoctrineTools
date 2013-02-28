<?php

namespace EmDoctrineTools;

use EmDoctrineTools\Service\SchemaUpdatesCollectorFactory;
use Zend\Loader\AutoloaderFactory,
    Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\BootstrapListenerInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface,
    Zend\ModuleManager\Feature\DependencyIndicatorInterface,
    Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, DependencyIndicatorInterface, ServiceProviderInterface
{

    /**
     * 
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            AutoloaderFactory::STANDARD_AUTOLOADER => [
                StandardAutoloader::LOAD_NS => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * 
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * 
     * @return array
     */
    public function getModuleDependencies()
    {
        return array('ZendDeveloperTools', 'DoctrineORMModule');
    }

    /**
     * 
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'emdt.schema_updates_collector.orm_default' => new SchemaUpdatesCollectorFactory('orm_default'),
            ],
        ];
    }

}
