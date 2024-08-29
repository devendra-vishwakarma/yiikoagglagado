<?php
use yii\filters\Cors;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'cookieValidationKey' => 'hello',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
            ],
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => \yii\web\JsonResponseFormatter::class,
                    'prettyPrint' => true, // Makes the JSON output more readable
                ],
            ],
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                $response->headers->add('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                $response->headers->add('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            },
        ],
        'corsFilter' => [
            'class' => Cors::class,
            'cors' => [
                'Origin' => ['http://localhost:5173'], // Replace with your allowed origins
                'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Allow-Headers' => ['Content-Type', 'Authorization'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Your URL rules here
            ],
        ],
        'db' => $db,
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
    ],
    'params' => $params,
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
