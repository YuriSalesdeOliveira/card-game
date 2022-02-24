<?php

namespace Source\Infra\Adapters;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Source\Infra\Presentation\Interfaces\TemplateEngineInterface;

class TwigTemplateEngine implements TemplateEngineInterface
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(path('views'));
        $this->twig = new Environment($loader, [
            'cache' => path('cache'),
            'debug' => true
        ]);
    }

    public function render(string $name, array $context = []): string
    {
        $name = str_replace('.', '/', $name) . '.html.twig';

        return $this->twig->render($name, $context);
    }
}