<?php

use Slim\Factory\AppFactory;

require_once dirname(__DIR__).'/vendor/autoload.php';

ob_start();
session_start();

$container = require path('config').'/container.php';
AppFactory::setContainer($container);

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

if ($basePath = app('site.basePath')) {
    $app->setBasePath($basePath);
}

$webRoutes = require path('routes').'/web.php';
$webRoutes($app);

$app->run();

ob_end_flush();
