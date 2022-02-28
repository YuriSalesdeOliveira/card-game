<?php

namespace Source\App\UseCases\CreateCardCollection;

class OutputBoundary
{
    public function __construct(
        private array $playerCardCollection,
        private array $machineCardCollection
    ) {}

    public function getPlayerCardCollection(): array
    {
        return $this->playerCardCollection;
    }

    public function getMachineCardCollection(): array
    {
        return $this->machineCardCollection;
    }
}