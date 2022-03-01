<?php

use function DI\get;
use function DI\create;
use DI\ContainerBuilder;
use function DI\autowire;

use Source\Infra\Adapters\TwigTemplateEngine;
use Source\App\UseCases\SelectCardCollection\SelectCardCollection;
use Source\Infra\Presentation\SelectCardCollectionPresenter;
use Source\Infra\Repositories\Memory\CardRepository;
use Source\Infra\Repositories\Memory\PlayerRepository;
use Source\Domain\Repositories\GetCardRepositoryInterface;
use Source\Domain\Repositories\GetPlayerRepositoryInterface;
use Source\Infra\Http\Controllers\Web\SelectCardCollectionController;
use Source\Infra\Presentation\Interfaces\TemplateEngineInterface;
use Source\Domain\Repositories\GetPlayerCardIdsRepositoryInterface;
use Source\App\UseCases\StartBattle\StartBattle;
use Source\Infra\Http\Controllers\Web\StartBattleController;

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
    // SelectCardCollection
    SelectCardCollection::class => autowire(SelectCardCollection::class),
    SelectCardCollectionPresenter::class => autowire(SelectCardCollectionPresenter::class),
    SelectCardCollectionController::class => autowire(SelectCardCollectionController::class),
    // StartBattle
    StartBattle::class => autowire(StartBattle::class),
    StartBattleController::class => autowire(StartBattleController::class),


]);

return $containerBuilder->build();
