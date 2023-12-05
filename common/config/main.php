<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => \Yii\rbac\DbManager::class,
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        // 'jwt' => [
        //     'issuer' => 'yiitask2',  //name of your project (for information only)
        //     'audience' => 'yiitask2',  //description of the audience, eg. the website using the authentication (for info only)
        //     'id' => 'UNIQUE-JWT-IDENTIFIER',  //a unique identifier for the JWT, typically a random string
        //     'expire' => 300,  //the short-lived JWT token is here set to expire after 5 min.
        //     'jwtValidationData' => \app\components\JwtValidationData::class,
        // ],
    ],
];
