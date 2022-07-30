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
        $resultOfRounds = $startedBattle['resultOfRounds'];

        $lastRoundResult = end($resultOfRounds);

        return $this->templateEngine->render('roundResult', [
            'page' => 'Round Result',
            'roundWinner' => $lastRoundResult['roundWinner'],
            'round' => $lastRoundResult['round'],
            'status' => $startedBattle['status'],
            'route' => $data['route']
        ]);
    }
}