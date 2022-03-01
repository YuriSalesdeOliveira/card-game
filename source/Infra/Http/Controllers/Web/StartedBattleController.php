<?php

namespace Source\Infra\Http\Controllers\Web;

use Psr\Http\Message\ResponseInterface as Response;
use Source\Infra\Presentation\StartedBattlePresenter;
use Psr\Http\Message\ServerRequestInterface as Request;

class StartedBattleController extends Controller
{
    public function __construct(
        private StartedBattlePresenter $presenter
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $response->getBody()->write(
            $this->presenter->output($_SESSION['startedBattle'])
        );

        return $response;
    }
}