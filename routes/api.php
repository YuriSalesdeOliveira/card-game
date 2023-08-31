<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {

        $group->get('', function (Request $request, Response $response) {
            $response->getBody()->write('api');

            return $response;
        });

        $group->get('/', function (Request $request, Response $response) {
            $response->getBody()->write('api');

            return $response;
        });

    });
};
