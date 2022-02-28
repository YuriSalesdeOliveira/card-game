<?php

use Slim\App;
use Source\Infra\Http\Controllers\Web\CreateCardCollectionController;
use Source\Infra\Http\Controllers\Web\SelectCardsController;

return function (App $app) {

    $app->get('/start-battle', [SelectCardsController::class, 'handle'])->setName('selectCards');

    $app->post(
        '/create/card-collection',
        [CreateCardCollectionController::class, 'handle']
    )->setName('createCardCollection');

};