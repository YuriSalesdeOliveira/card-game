<?php

namespace Source\Domain\Repositories\Player;

use Source\Domain\Entities\Player;

interface GetPlayerCardIdsRepositoryInterface
{
    public function getPlayerCardIds(Player $player): array|false;
}