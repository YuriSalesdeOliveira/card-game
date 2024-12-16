<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$container = require path('config').'/container.php';
AppFactory::setContainer($container);

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

if ($basePath = app('site.basePath')) {
    $app->setBasePath($basePath);
}

$webRoutes = require path('routes').'/web.php';
$webRoutes($app);

return $app;
