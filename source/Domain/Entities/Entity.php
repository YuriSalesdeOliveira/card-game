<?php

namespace Source\domain\Entities;

use DateTimeInterface;
use DomainException;

abstract class Entity
{
    protected bool $timestamp = true;

    protected DateTimeInterface $createdAt;

    protected DateTimeInterface $updatedAt;

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        if (! $this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): void
    {
        if (! $this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        if (! $this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        if (! isset($this->createdAt)) {
            throw new DomainException('There is no create date');
        }

        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        if (! $this->timestamp) {
            throw new DomainException('The timestamp is off for that entity.');
        }

        if (! isset($this->updatedAt)) {
            throw new DomainException('There is no update date');
        }

        return $this->updatedAt;
    }

    public function __isset(string $attribute): bool
    {
        return isset($this->$attribute);
    }

    abstract public function toArray(): array;
}
