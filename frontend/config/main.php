<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'eventController', 'bootstrap'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'bootstrap' => [
            'class' => 'frontend\components\Bootstrap',
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    'basePath' => "@frontend/messages"
                ]
            ]
        ],
        'eventController' => [
            'class' => 'frontend\components\EventController',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity', 
                'httpOnly' => true,
                'domain' => 'yii2.advanced'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        /* 'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ], */
        
    ],
    'params' => $params,
];
