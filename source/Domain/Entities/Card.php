<?php

namespace Source\Domain\Entities;

use DateTimeInterface;
use Source\Domain\ValueObjects\Name;
use Source\Domain\ValueObjects\Image;
use Source\Domain\ValueObjects\Identity;

class Card extends Entity
{
    public function __construct(
        Identity $id,
        Image $image,
        Name $name,
        int $intelligence,
        int $force,
        int $velocity,
        int $resistance,
        int $fighting,
        int $power,
        int $overall,
        DateTimeInterface $createdAt,
        DateTimeInterface $updatedAt
    ) {
        $this->attributes = [
            'id' => $id,
            'image' => $image,
            'name' => $name,
            'intelligence' => $intelligence,
            'force' => $force,
            'velocity' => $velocity,
            'resistance' => $resistance,
            'fighting' => $fighting,
            'power' => $power,
            'overall' => $overall,
            'createdAt' => $createdAt,
            'updatedAt' => $updatedAt
        ];
    }
    // setters
    public function setId(Identity $id): void
    {
        $this->attributes['id'] = $id;
    }
    public function setImage(Image $image): void
    {
        $this->attributes['image'] = $image;
    }
    public function setName(Name $name): void
    {
        $this->attributes['name'] = $name;
    }
    public function setIntelligence(int $intelligence): void
    {
        $this->attributes['intelligence'] = $intelligence;
    }
    public function setForce(int $force): void
    {
        $this->attributes['force'] = $force;
    }
    public function setVelocity(int $velocity): void
    {
        $this->attributes['velocity'] = $velocity;
    }
    public function setResistance(int $resistance): void
    {
        $this->attributes['resistance'] = $resistance;
    }
    public function setFighting(int $fighting): void
    {
        $this->attributes['fighting'] = $fighting;
    }
    public function setPower(int $power): void
    {
        $this->attributes['power'] = $power;
    }
    public function setOverall(int $overall): void
    {
        $this->attributes['overall'] = $overall;
    }
    // getters
    public function getId(): Identity
    {
        return $this->attributes['id'];
    }
    public function getImage(): Image
    {
        return $this->attributes['image'];
    }
    public function getName(): Name
    {
        return $this->attributes['name'];
    }
    public function getIntelligence(): int
    {
        return $this->attributes['intelligence'];
    }
    public function getForce(): int
    {
        return $this->attributes['force'];
    }
    public function getVelocity(): int
    {
        return $this->attributes['velocity'];
    }
    public function getResistance(): int
    {
        return $this->attributes['resistance'];
    }
    public function getFighting(): int
    {
        return $this->attributes['fighting'];
    }
    public function getPower(): int
    {
        return $this->attributes['power'];
    }
    public function getOverall(): int
    {
        return $this->attributes['overall'];
    }
}