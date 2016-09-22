<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/../app/templates',
//          'template_path' => __DIR__ . '/templates',
//          'template_path' => 'app/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
//              'cache' => false,
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        'db' => [
            // Illuminate/database configuration
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'slim',
            'username'  => 'slim',
            'password'  => 'SlImPaSs',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
    ],
];
