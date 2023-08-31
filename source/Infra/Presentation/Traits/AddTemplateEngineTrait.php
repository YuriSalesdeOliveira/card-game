<?php

namespace Source\Infra\Presentation\Traits;

use Source\Infra\Presentation\Interfaces\TemplateEngineInterface;

trait AddTemplateEngineTrait
{
    protected TemplateEngineInterface $templateEngine;

    public function __construct(TemplateEngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }
}
