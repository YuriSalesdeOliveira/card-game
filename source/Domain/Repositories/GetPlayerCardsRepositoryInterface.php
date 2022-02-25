<?php

namespace Source\Domain\Repositories;

use Source\Domain\Entities\Player;

interface GetPlayerCardsRepositoryInterface
{
    public function getPlayerCards(Player $player): array;
}