<?php

namespace Source\Infra\Presentation;

use Source\Infra\Http\Controllers\Web\PresenterInterface;
use Source\Infra\Presentation\Traits\AddTemplateEngineTrait;

class StartBattlePresenter implements PresenterInterface
{
    use AddTemplateEngineTrait;

    public function output(array $data): string
    {
        $cards = [];

        foreach ($data as $card) {
            
            unset($card['createdAt']);

            array_push($cards, $card);
        }

        return $this->templateEngine->render('startBattle', [
            'page' => 'Start Battle',
            'cards' => $cards
        ]);
    }
}