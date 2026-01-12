<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'es-ES', // Idioma español global
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'locale' => 'es-ES',
            'currencyCode' => 'EUR',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'defaultTimeZone' => 'Europe/Madrid',
            'timeZone' => 'Europe/Madrid',
        ],
    ],
];
