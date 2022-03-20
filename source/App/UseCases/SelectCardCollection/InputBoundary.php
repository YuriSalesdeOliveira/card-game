<?php

namespace Source\App\UseCases\SelectCardCollection;

class InputBoundary
{
    public function __construct(
        private string $playerId
    ) {}

    public function getPlayerId(): string
    {
        return $this->playerId;
    }
}