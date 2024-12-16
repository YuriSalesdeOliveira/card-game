<?php

namespace Source\Infra\Adapters;

use Source\Infra\Presentation\Interfaces\TemplateEngineInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigTemplateEngine implements TemplateEngineInterface
{
    protected Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(path('views'));
        $this->twig = new Environment($loader, [
            'cache' => path('storage').'/twig/cache',
            'debug' => true,
        ]);

        $functions = require path('config').'/twig.php';

        foreach ($functions as $function) {
            $this->twig->addFunction($function);
        }
    }

    public function render(string $name, array $context = []): string
    {
        $name = str_replace('.', '/', $name).'.html.twig';

        return $this->twig->render($name, $context);
    }
}
