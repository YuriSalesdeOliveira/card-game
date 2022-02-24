<?php

use function DI\get;
use function DI\create;
use DI\ContainerBuilder;
use function DI\autowire;
use Source\Infra\Adapters\TwigTemplateEngine;
use Source\Infra\Presentation\Interfaces\TemplateEngineInterface;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([

    PDO::class => create(PDO::class)->constructor(
        database('dsn'),
        database('username'),
        database('password'),
        database('options')
    ),

    TemplateEngineInterface::class => autowire(TwigTemplateEngine::class),
]);

return $containerBuilder->build();
