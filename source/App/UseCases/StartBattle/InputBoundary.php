<?php

namespace Source\App\UseCases\StartBattle;

class InputBoundary
{
    public function __construct(
        private array $cardIds
    ) {}

    public function getCardIds(): array
    {
        return $this->cardIds;
    }
}
