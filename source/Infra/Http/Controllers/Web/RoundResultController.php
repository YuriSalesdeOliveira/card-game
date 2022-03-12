<?php

namespace Source\Infra\Http\Controllers\Web;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Source\Infra\Presentation\RoundResultPresenter;
use Slim\Routing\RouteContext;

class RoundResultController extends Controller
{
    public function __construct(
        private RoundResultPresenter $presenter
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $response->getBody()->write(
            $this->presenter->output([
                'roundResults' => $_SESSION['startedBattle']['roundResults'],
                'route' => $routeParser
            ])
        );

        return $response;
    }
}