<?php

namespace Source\App\UseCases\StartBattle;

class OutputBoundary
{
    public function __construct(
        private array $cards
    ) {}

    public function getCards()
    {
        return $this->cards;
    }
}