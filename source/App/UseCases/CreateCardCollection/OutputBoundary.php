<?php

namespace Source\App\UseCases\CreateCardCollection;

class OutputBoundary
{
    public function __construct(
        private array $cardCollection
    ) {}

    public function getCardCollection(): array
    {
        return $this->cardCollection;
    }
}