<?php

namespace Source\Infra\Http\Controllers\Web;

use Source\App\UseCases\SelectCardCollection\SelectCardCollection;
use Source\App\UseCases\SelectCardCollection\InputBoundary;
use Psr\Http\Message\ResponseInterface as Response;
use Source\Infra\Presentation\SelectCardCollectionPresenter;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;

class SelectCardCollectionController extends Controller
{
    public function __construct(
        private SelectCardCollection $useCase,
        private SelectCardCollectionPresenter $presenter
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $input = new InputBoundary('b0783a1f6d678676111ba958db3ae9db');

        $output = $this->useCase->handle($input);

        $response->getBody()->write(
            $this->presenter->output([
                'cards' => $output->getCards(),
                'route' => $routeParser
            ])
        );

        return $response;
    }
}