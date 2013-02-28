<?php

return [
    'controllers' => [
        'invokables' => [
            'EmDoctrineTools\Controller\Schema' => 'EmDoctrineTools\Controller\SchemaController',
        ],
    ],
    'router' => [
        'routes' => [
            'em-doctrine-tools' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/em-doctrine-tools/:controller/:action/:schema',
                    'constraints' => [
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'schema' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'EmDoctrineTools\Controller',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'zend-developer-tools/toolbar/doctrine-schema-updates' => __DIR__ . '/../view/zend-developer-tools/toolbar/doctrine-schema-updates.phtml',
        ],
    ],
    'zenddevelopertools' => [
        'profiler' => [
            'collectors' => [
                'orm_default_schema_updates' => 'emdt.schema_updates_collector.orm_default'
            ],
        ],
        'toolbar' => [
            'entries' => [
                'orm_default_schema_updates' => 'zend-developer-tools/toolbar/doctrine-schema-updates',
            ],
        ],
    ],
];
