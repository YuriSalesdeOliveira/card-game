<?php

namespace Source\Domain\Entities;

abstract class Entity
{
    protected array $attributes;

    public function toArray(): array
    {
        return $this->attributes;
    }

    abstract public function __toString(): string;
}