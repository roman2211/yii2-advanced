<?php

// telegram bot ip 812989643:AAE9kulzxy8RFuuZ24BhVWJY1nqv0WssTNs
// telegram bot  t.me/yii2TasksBot
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
