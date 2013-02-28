<?php

namespace EmDoctrineTools\Service;

use EmDoctrineTools\Collector\SchemaUpdatesCollector;
use RuntimeException;
use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class SchemaUpdatesCollectorFactory implements FactoryInterface
{

    /**
     *
     * @var string
     */
    protected $name;

    /**
     * 
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    /**
     * 
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return \EmykiDoctrineTools\Collector\SchemaUpdatesCollector
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = 'doctrine.entitymanager.' . $this->name;
        if (!$serviceLocator->has($service)) {
            throw new RuntimeException('Service not available: ' . $service);
        }

        $entityManager = $serviceLocator->get($service);
        $collector = new SchemaUpdatesCollector($entityManager, $this->name . '_schema_updates');
        return $collector;
    }

}
