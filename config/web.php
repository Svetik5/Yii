<?php

$params = require __DIR__ . '/params.php';
$db = file_exists(__DIR__.'/db_local.php')
    ? (require __DIR__ . '/db_local.php')
    : (require __DIR__.'/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-Ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'as datecreated'=>['class'=>\app\behaviors\LogMyBehavior::class],
    'components' => [
        'formatter'=>[
        'dateFormat' => 'd.m.Y'
        ],
        'auth'=>['class'=>\app\components\AuthComponent::class],
        'activity' => ['class'=>\app\components\ActivityComponent::class,
           'model_class' => \app\models\Activity::class
        ],
        'rbac' => ['class' => \app\components\RbacComponent::class],
        'authManager' => [
            'class'=>\yii\rbac\DbManager::class],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'JECNA8gcWUeo32flWxLTrFJurY_8om-r',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
           // 'class' => 'yii\caching\MemCache',
       //     'useMemcached' => true
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
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
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
