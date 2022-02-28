<?php

namespace Source\App\UseCases\SelectCards;

class InputBoundary
{
    public function __construct(
        private string $id
    ) {}

    public function getId(): string
    {
        return $this->id;
    }
}