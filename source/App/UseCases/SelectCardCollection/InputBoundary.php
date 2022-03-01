<?php

namespace Source\App\UseCases\SelectCardCollection;

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