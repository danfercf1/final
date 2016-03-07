<?php
/**
 * Application configuration shared by all test types
 */
return [
    /*'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'fixtureDataPath' => '@tests/codeception/fixtures',
            'templatePath' => '@tests/codeception/templates',
            'namespace' => 'tests\codeception\fixtures',
        ],
    ],*/
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://admin:admin@localhost:27017/datos',
        ],
        /*'db' => [
            'dsn' => 'mysql:host=localhost;dbname=yii2_basic_tests',
        ],*/
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
