<?php

namespace Source\Domain\Repositories\Player;

use Source\Domain\Entities\Player;
use Source\Domain\ValueObjects\Identity;

interface GetPlayerRepositoryInterface
{
    public function getPlayerById(Identity $id): Player|false;
}
