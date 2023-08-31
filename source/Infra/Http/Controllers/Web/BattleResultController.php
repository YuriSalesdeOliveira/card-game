<?php

namespace Source\Infra\Http\Controllers\Web;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Source\Infra\Presentation\BattleResultPresenter;

class BattleResultController
{
    public function __construct(
        private BattleResultPresenter $presenter
    ) {
    }

    public function handle(Request $request, Response $response): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $response->getBody()->write(
            $this->presenter->output([
                'startedBattle' => $_SESSION['startedBattle'],
                'route' => $routeParser,
            ])
        );

        return $response;
    }
}
