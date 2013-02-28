<?php

namespace EmDoctrineTools\Collector;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Zend\Mvc\MvcEvent;
use ZendDeveloperTools\Collector\CollectorInterface,
    ZendDeveloperTools\Collector\AutoHideInterface;

class SchemaUpdatesCollector implements AutoHideInterface, CollectorInterface//, \Serializable
{
    /**
     * Collector priority
     */

    const PRIORIRY = 10;

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var array
     */
    protected $updates;

    /**
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, $name)
    {
        $this->name = (string) $name;

        /**
         * @todo Move this to 'collect' method, use $this->entityManager and implement \Serilizable
         */
        $schemaTool = new SchemaTool($entityManager);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $this->updates = $schemaTool->getUpdateSchemaSql($metadata);
    }

    /**
     * 
     * @return boolean
     */
    public function canHide()
    {
        return empty($this->updates);
    }

    /**
     * 
     * @param \Zend\Mvc\MvcEvent $mvcEvent
     */
    public function collect(MvcEvent $mvcEvent)
    {
        
    }

    /**
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     * @return integer
     */
    public function getPriority()
    {
        return static::PRIORIRY;
    }

    /**
     * 
     * @return array
     */
    public function getUpdates()
    {
        return $this->updates;
    }

    /**
     * 
     * @return integer
     */
    public function getUpdatesCount()
    {
        return count($this->updates);
    }

}
