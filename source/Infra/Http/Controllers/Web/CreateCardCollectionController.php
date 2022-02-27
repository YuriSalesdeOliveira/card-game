<?php

namespace Source\Infra\Http\Controllers\Web;

use Source\App\UseCases\CreateCardCollection\CreateCardCollection;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Source\App\UseCases\CreateCardCollection\InputBoundary;

class CreateCardCollectionController extends Controller
{
    public function __construct(
        private CreateCardCollection $useCase
    ) {}

    public function handle(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $input = new InputBoundary($data['card-collection']);

        $output = $this->useCase->handle($input);
        print_r($output);
        return $response
            ->withHeader('Location', '')
            ->withStatus(303);
    }
}