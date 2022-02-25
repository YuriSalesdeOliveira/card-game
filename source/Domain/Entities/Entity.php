<?php

namespace Source\domain\Entities;

use DateTimeInterface;
use DomainException;

abstract class Entity
{
    protected array $attributes;
    protected bool $timestamp = true;

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        if (!$this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        $this->attributes['createdAt'] = $createdAt;
    }
    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        if (!$this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        $this->attributes['updatedAt'] = $updatedAt;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        if (!$this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        return $this->attributes['createdAt'];
    }
    public function getUpdatedAt(): DateTimeInterface
    {
        if (!$this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        return $this->attributes['updatedAt'];
    }

    public function toArray(): array
    {
        return $this->attributes;
    }
}