<?php

return [

    'default' => env('db_connection', 'mysql'),

    'connections' => [

        'mysql' => [
            'dsn' => sprintf(
                '%s:host=%s;port=%s;dbname=%s;charset=%s',
                env('db_connection'), env('host'), env('port'), env('database'), env('charset')
            ),
            'driver' => 'mysql',
            'host' => env('host'),
            'port' => env('port'),
            'database' => env('database'),
            'username' => env('username'),
            'password' => env('password'),
            'charset' => env('charset'),
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_CASE => PDO::CASE_NATURAL
            ]
        ]

    ]

];