<?php

function path(string $key, string $default = ''): string
{
    $path = require dirname(__FILE__).'/paths.php';

    return empty($path[$key]) ? $default : $path[$key];
}

function env(string $key, string $default = ''): string
{
    $key = strtoupper($key);

    $env = parse_ini_file(dirname(__DIR__).'/env.ini');

    return empty($env[$key]) ? $default : $env[$key];
}

function database(string $key, string $default = '', string $environment = ''): string|array
{
    $database = require dirname(__FILE__).'/database.php';

    $environment = $environment !== '' ? $environment : $database['environment_default'];

    $connection = $database['environments'][$environment];

    return empty($connection[$key]) ? $default : $connection[$key];
}

function app(string $key, string $default = ''): string|array
{
    $keyAsArray = explode('.', $key);

    $app = require dirname(__FILE__).'/app.php';

    foreach ($keyAsArray as $key) {

        if (is_array($app)) {

            $app = $app[$key];

            continue;
        }

        throw new Exception("Undefined array key \"$key\"");
    }

    return empty($app) ? $default : $app;
}
