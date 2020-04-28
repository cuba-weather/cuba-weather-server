<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => \Da\User\Component\AuthDbManagerComponent::class,
        ],
    ],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            'allowAccountDelete' => true,
            'administratorPermissionName' => 'admin',
            'classMap' => [
                'User' => \common\models\User::class,
            ],
        ],
    ]
];
