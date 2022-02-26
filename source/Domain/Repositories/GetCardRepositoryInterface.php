<?php

namespace Source\Domain\Repositories;

use Source\Domain\Entities\Card;
use Source\Domain\ValueObjects\Identity;

interface GetCardRepositoryInterface
{
    public function getCardById(Identity $id): Card;
}