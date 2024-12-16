<?php

namespace Source\Infra\Http\Controllers\Web;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Source\App\UseCases\ToBattle\InputBoundary;
use Source\App\UseCases\ToBattle\ToBattle;

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
            ->withHeader('Location', $routeParser->fullUrlFor($request->getUri(), 'roundResult'))
            ->withStatus(303);
    }
}
