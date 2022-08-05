<?php

use function DI\get;
use function DI\create;
use DI\ContainerBuilder;
use function DI\autowire;

use Source\Infra\Adapters\TwigTemplateEngine;
use Source\Infra\Repositories\Memory\CardRepository;
use Source\Infra\Repositories\Memory\PlayerRepository;
use Source\Domain\Repositories\Card\GetCardRepositoryInterface;
use Source\Domain\Repositories\Player\GetPlayerRepositoryInterface;
use Source\Infra\Presentation\Interfaces\TemplateEngineInterface;
use Source\Domain\Repositories\Player\GetPlayerCardIdsRepositoryInterface;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([

    PDO::class => create(PDO::class)->constructor(
        database('dsn'),
        database('username'),
        database('password'),
        database('options')
    ),

    TemplateEngineInterface::class => autowire(TwigTemplateEngine::class),

    GetPlayerRepositoryInterface::class => get(PlayerRepository::class),
    GetPlayerCardIdsRepositoryInterface::class => get(PlayerRepository::class),
    GetCardRepositoryInterface::class => get(CardRepository::class),

]);

return $containerBuilder->build();
