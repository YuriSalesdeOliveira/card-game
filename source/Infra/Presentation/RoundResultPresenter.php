<?php

namespace Source\Infra\Presentation;

use Source\Infra\Http\Controllers\Web\PresenterInterface;
use Source\Infra\Presentation\Traits\AddTemplateEngineTrait;

class RoundResultPresenter implements PresenterInterface
{
    use AddTemplateEngineTrait;

    public function output(array $data): string
    {
        $roundResult = end($data['roundResults']);

        return $this->templateEngine->render('roundResult', [
            'page' => 'Round Result',
            'roundResult' => $roundResult,
            'route' => $data['route']
        ]);
    }
}