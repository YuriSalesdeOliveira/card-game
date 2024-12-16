<?php

namespace Source\App\UseCases\StartBattle;

class OutputBoundary
{
    public function __construct(
        private array $battle
    ) {}

    public function getBattle(): array
    {
        return $this->battle;
    }
}
