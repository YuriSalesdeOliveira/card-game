<?php

use Slim\App;
use Source\Infra\Http\Controllers\Web\CreateCardCollectionController;
use Source\Infra\Http\Controllers\Web\StartBattleController;

return function (App $app) {

    $app->get('/start-battle', [StartBattleController::class, 'handle'])->setName('startBattle');

    $app->post(
        '/create/card-collection',
        [CreateCardCollectionController::class, 'handle']
    )->setName('createCardCollection');

};