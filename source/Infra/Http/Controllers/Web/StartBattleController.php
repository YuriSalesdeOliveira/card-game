<?php

namespace Source\Infra\Http\Controllers\Web;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Source\App\UseCases\StartBattle\InputBoundary;
use Source\App\UseCases\StartBattle\StartBattle;

class StartBattleController extends Controller
{
    public function __construct(
        private StartBattle $useCase
    ) {}

    public function handle(Request $request, Response $response)
    {
        $input = new InputBoundary('b0783a1f6d678676111ba958db3ae9db');

        $output = $this->useCase->handle($input);
        print_r($output);
        return $response;
    }
}