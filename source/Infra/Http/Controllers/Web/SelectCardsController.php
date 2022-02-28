<?php

namespace Source\Infra\Http\Controllers\Web;

use Source\App\UseCases\SelectCards\SelectCards;
use Source\App\UseCases\SelectCards\InputBoundary;
use Psr\Http\Message\ResponseInterface as Response;
use Source\Infra\Presentation\SelectCardsPresenter;
use Psr\Http\Message\ServerRequestInterface as Request;

class SelectCardsController extends Controller
{
    public function __construct(
        private SelectCards $useCase,
        private SelectCardsPresenter $presenter
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $input = new InputBoundary('b0783a1f6d678676111ba958db3ae9db');

        $output = $this->useCase->handle($input);

        $response->getBody()->write(
            $this->presenter->output($output->getCards())
        );

        return $response;
    }
}