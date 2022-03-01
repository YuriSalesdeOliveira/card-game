<?php

namespace Source\Infra\Http\Controllers\Web;

use Source\App\UseCases\StartBattle\StartBattle;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Source\App\UseCases\StartBattle\InputBoundary;

class StartBattleController extends Controller
{
    public function __construct(
        private StartBattle $useCase
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $input = new InputBoundary($data['card-collection']);

        $output = $this->useCase->handle($input);

        return $response
            ->withHeader('Location', '')
            ->withStatus(303);
    }
}