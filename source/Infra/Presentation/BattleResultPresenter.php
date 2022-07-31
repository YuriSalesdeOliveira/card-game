<?php

namespace Source\Infra\Presentation;

use Source\Infra\Http\Controllers\Web\PresenterInterface;
use Source\Infra\Presentation\Traits\AddTemplateEngineTrait;

class BattleResultPresenter implements PresenterInterface
{
    use AddTemplateEngineTrait;

    public function output(array $data): string
    {
        $battleWinner = '';

        if (isset($data['startedBattle']['battleWinner'])) {

            $battleWinner = $data['startedBattle']['battleWinner'];
        }

        $message = $battleWinner === 'player' ?
            'Congratulations, you won the battle, but will you win the next one?' :
            "Don't be discouraged! You won't lose your cards, start a new battle.";

        return $this->templateEngine->render('battleResult', [
            'page' => 'Battle Result',
            'battleWinner' => $battleWinner,
            'message' => $message,
            'route' => $data['route']
        ]);
    }
}