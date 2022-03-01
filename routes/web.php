<?php

use Slim\App;
use Source\Infra\Http\Controllers\Web\StartBattleController;
use Source\Infra\Http\Controllers\Web\SelectCardCollectionController;

return function (App $app) {

    $app->get(
        '/start-battle',
        [SelectCardCollectionController::class, 'handle']
    )->setName('selectCardCollection');

    $app->post(
        '/create/card-collection',
        [StartBattleController::class, 'handle']
    )->setName('startBattle');

};