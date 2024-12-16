<?php

function path(string $key, ?string $default = null): ?string
{
    $path = require dirname(__FILE__).'/paths.php';

    return $path[$key] ?? $default;
}

function env(string $key, ?string $default = null): ?string
{
    return $_ENV[strtoupper($key)] ?? $default;
}

function database(string $key, ?string $default = null): string|array|null
{
    $database = require dirname(__FILE__).'/database.php';

    return $database[$key] ?? $default;
}

/**
 * @throws Exception
 */
function app(string $key, ?string $default = null): string|array|null
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

    return $app ?? $default;
}
