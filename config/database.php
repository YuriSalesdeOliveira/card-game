<?php

return [
    'dsn' => sprintf(
        '%s:host=%s;port=%s;dbname=%s;charset=%s',
        env('db_driver'),
        env('db_host'),
        env('db_port'),
        env('db_database'),
        env('db_charset')
    ),
    'username' => env('db_username'),
    'password' => env('db_password'),
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
    ],
];
