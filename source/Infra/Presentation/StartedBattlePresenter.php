<?php

namespace Source\Infra\Presentation;

use Source\Infra\Http\Controllers\Web\PresenterInterface;
use Source\Infra\Presentation\Traits\AddTemplateEngineTrait;

class StartedBattlePresenter implements PresenterInterface
{
    use AddTemplateEngineTrait;

    public function output(array $data): string
    {
        return $this->templateEngine->render('startedBattle', [
            'page' => 'Started Battle',
            'battle' => $data['battle'],
            'route' => $data['route'],
        ]);
    }
}
