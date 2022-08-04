<?php

namespace Source\Domain\Repositories;

use Source\Domain\Entities\Player;

interface GetPlayerCardIdsRepositoryInterface
{
    public function getPlayerCardIds(Player $player): array|false;
}