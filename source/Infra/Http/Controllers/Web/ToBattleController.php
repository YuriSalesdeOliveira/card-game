<?php

namespace Source\Infra\Http\Controllers\Web;

use Slim\Routing\RouteContext;
use Source\App\UseCases\ToBattle\ToBattle;
use Source\App\UseCases\ToBattle\InputBoundary;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ToBattleController
{
    public function __construct(
        private ToBattle $useCase
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $data = $request->getParsedBody();

        $input = new InputBoundary(
            $data['card-to-battle'],
            $_SESSION['startedBattle']
        );

        $output = $this->useCase->handle($input);

        $_SESSION['startedBattle'] = $output->getBattle();

        return $response
        ->withHeader('Location', $routeParser->fullUrlFor($request->getUri(), 'startedBattle'))
        ->withStatus(303);
    }
}