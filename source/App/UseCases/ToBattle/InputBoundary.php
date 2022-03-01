<?php

namespace Source\App\UseCases\ToBattle;

class InputBoundary
{
    public function __construct(
        private string $cardToBattleId,
        private array $battle
    ) {}

    public function getCardToBattleId(): string
    {
        return $this->cardToBattleId;
    }

    public function getBattle(): array
    {
        return $this->battle;
    }
}