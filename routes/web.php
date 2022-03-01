<?php

use Slim\App;
use Source\Infra\Http\Controllers\Web\StartBattleController;
use Source\Infra\Http\Controllers\Web\StartedBattleController;
use Source\Infra\Http\Controllers\Web\SelectCardCollectionController;

return function (App $app) {

    $app->get(
        '/select-card-collection',
        [SelectCardCollectionController::class, 'handle']
    )->setName('selectCardCollection');

    $app->post(
        '/start-battle',
        [StartBattleController::class, 'handle']
    )->setName('startBattle');

    $app->get(
        '/started-battle',
        [StartedBattleController::class, 'handle']
    )->setName('startedBattle');

    $app->post(
        '/to-battle',
        [ToBattleController::class, 'handle']
    )->setName('toBattle');

};