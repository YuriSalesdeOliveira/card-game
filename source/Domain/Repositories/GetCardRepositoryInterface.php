<?php

namespace Source\Domain\Repositories;

use Source\Domain\Entities\Card;
use Source\Domain\ValueObjects\Identity;

interface GetCardRepositoryInterface
{
    public function getCardById(Identity $id): Card;
    public function getCardsById(array $ids): array;
    public function getRandomCards(int $limit): array;
}