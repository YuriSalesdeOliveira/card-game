<?php

namespace Source\Infra\Presentation;

use Source\Infra\Presentation\Interfaces\TemplateEngineInterface;

abstract class AbstractPresenterWithTemplateEngine
{
    protected TemplateEngineInterface $templateEngine;

    public function __construct(TemplateEngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }
}