<?php

namespace Source\Infra\Presentation;

use Source\Infra\Http\Controllers\Web\PresenterInterface;
use Source\Infra\Presentation\Traits\AddTemplateEngineTrait;

class RoundResultPresenter implements PresenterInterface
{
    use AddTemplateEngineTrait;

    public function output(array $data): string
    {
        $startedBattle = $data['startedBattle'];
        $roundResults = $startedBattle['roundResults'];

        $lastRoundResult = end($roundResults);

        return $this->templateEngine->render('roundResult', [
            'page' => 'Round Result',
            'winner' => $lastRoundResult['winner'],
            'round' => $lastRoundResult['round'],
            'status' => $startedBattle['status'],
            'route' => $data['route']
        ]);
    }
}