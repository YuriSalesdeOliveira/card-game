<?php

namespace Source\Infra\Http\Controllers\Web;

use Source\App\UseCases\StartBattle\InputBoundary;
use Source\App\UseCases\StartBattle\StartBattle;

class StartBattleController extends Controller
{
    public function __construct(
        private StartBattle $useCase
    ) {}

    public function handle($request, $response)
    {
        $input = new InputBoundary('');

        $output = $this->useCase->handle($input);

        return $response;
    }
}