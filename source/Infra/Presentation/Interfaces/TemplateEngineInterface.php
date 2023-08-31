<?php

namespace Source\Infra\Presentation\Interfaces;

interface TemplateEngineInterface
{
    public function render(string $name, array $context = []): string;
}
