<?php

require_once dirname(__DIR__).'/vendor/autoload.php';

ob_start();
session_start();

$app = require path('bootstrap') . '/app.php';
$app->run();

ob_end_flush();
