<?php

namespace Source\App\UseCases\SelectCardCollection;

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