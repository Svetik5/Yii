<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__.'/db_local.php')
    ? (require __DIR__ . '/db_local.php')
    : (require __DIR__.'/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'authManager' => [
            'class'=>\yii\rbac\DbManager::class],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' => true,
            'transport' => [
                'class' => 'Swift_SmptTransport',
                'host' => 'smpt.yandex.ru',
                'username' => 'cveto4ek575@yandex.ru',
                'password' => '30011990s',
                'port' => '587',
                'encryption' => 'tls'
            ]
            ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
