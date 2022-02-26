<?php

namespace Source\Infra\Http\Controllers\Web;

use Source\App\UseCases\StartBattle\StartBattle;
use Source\App\UseCases\StartBattle\InputBoundary;
use Psr\Http\Message\ResponseInterface as Response;
use Source\Infra\Presentation\StartBattlePresenter;
use Psr\Http\Message\ServerRequestInterface as Request;

class StartBattleController extends Controller
{
    public function __construct(
        private StartBattle $useCase,
        private StartBattlePresenter $presenter
    ) {}

    public function handle(Request $request, Response $response)
    {
        $input = new InputBoundary('b0783a1f6d678676111ba958db3ae9db');

        $output = $this->useCase->handle($input);

        $response->getBody()->write(
            $this->presenter->output($output->getCards())
        );

        return $response;
    }
}