<?php

namespace Source\Domain\Repositories\Card;

use Source\Domain\Entities\Card;
use Source\Domain\ValueObjects\Identity;

interface GetCardRepositoryInterface
{
    public function getCardById(Identity $id): Card|false;

    public function getCardsById(array $ids): array;

    public function getRandomCards(int $limit): array;
}
