<?php

namespace Source\Infra\Presentation;

use Source\Infra\Http\Controllers\Web\PresenterInterface;
use Source\Infra\Presentation\Traits\AddTemplateEngineTrait;

class SelectCardCollectionPresenter implements PresenterInterface
{
    use AddTemplateEngineTrait;

    public function output(array $data): string
    {
        $route = $data['route'];
        $cards = [];

        foreach ($data['cards'] as $card) {
            
            unset($card['createdAt']);

            $cards[] = $card;
        }

        return $this->templateEngine->render('selectCardCollection', [
            'page' => 'Select a Heroes Card Collection',
            'cards' => $cards,
            'route' => $route
        ]);
    }
}