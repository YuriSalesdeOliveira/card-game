<?php

namespace Source\Infra\Http\Controllers\Web;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Source\Infra\Presentation\StartedBattlePresenter;

class StartedBattleController extends Controller
{
    public function __construct(
        private StartedBattlePresenter $presenter
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $response->getBody()->write(
            $this->presenter->output([
                'battle' => $_SESSION['startedBattle'],
                'route' => $routeParser,
            ])
        );

        return $response;
    }
}
