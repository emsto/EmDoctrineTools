<?php

namespace EmDoctrineTools\Controller;

use Doctrine\ORM\Tools\SchemaTool;
use Zend\Mvc\Controller\AbstractActionController;

class SchemaController extends AbstractActionController
{

    public function updateAction()
    {
        $schema = $this->params()->fromRoute('schema');

        $entityManager = $this->getServiceLocator()->get("doctrine.entitymanager.{$schema}");

        $schemaTool = new SchemaTool($entityManager);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool->updateSchema($metadata);

        $this->flashMessenger()->addInfoMessage("Schema {} updated!");
        $this->redirect()->toRoute('home');
    }

}
