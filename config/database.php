<?php

return [

    'environment_default' => env('environment', 'development'),

    'environments' => [

        'production' => [
            'dsn' => sprintf(
                '%s:host=%s;port=%s;dbname=%s;charset=%s',
                env('prod_driver'),
                env('prod_host'),
                env('prod_port'),
                env('prod_database'),
                env('prod_charset')
            ),
            'driver' => env('prod_driver'),
            'host' => env('prod_host'),
            'port' => env('prod_port'),
            'database' => env('prod_database'),
            'username' => env('prod_username'),
            'password' => env('prod_password'),
            'charset' => env('prod_charset'),
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_CASE => PDO::CASE_NATURAL
            ]
        ],

        'development' => [
            'dsn' => sprintf(
                '%s:host=%s;port=%s;dbname=%s;charset=%s',
                env('dev_driver'),
                env('dev_host'),
                env('dev_port'),
                env('dev_database'),
                env('dev_charset')
            ),
            'driver' => env('dev_driver'),
            'host' => env('dev_host'),
            'port' => env('dev_port'),
            'database' => env('dev_database'),
            'username' => env('dev_username'),
            'password' => env('dev_password'),
            'charset' => env('dev_charset'),
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_CASE => PDO::CASE_NATURAL
            ]
        ]
    ]

];