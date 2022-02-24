<?php

use Slim\Factory\AppFactory;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

$container = require(dirname(__DIR__) . '/config/container.php');
AppFactory::setContainer($container);

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->setBasePath('/pdf-generator');

$webRoutes = require(dirname(__DIR__) . '/routes/web.php');
$apiRoutes = require(dirname(__DIR__) . '/routes/api.php');

$webRoutes($app);
$apiRoutes($app);

$app->run();
