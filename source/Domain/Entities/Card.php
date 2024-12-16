<?php

namespace Source\Domain\Entities;

use DateTimeInterface;
use DomainException;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\ValueObjects\Image;
use Source\Domain\ValueObjects\Name;

class Card extends Entity
{
    public function __construct(
        private Identity $id,
        private Image $image,
        private Name $name,
        private int $intelligence,
        private int $force,
        private int $velocity,
        private int $resistance,
        private int $fighting,
        private int $power,
        private int $overall,
        protected DateTimeInterface $createdAt,
    ) {}

    public static function toCard(array $cardsAsArray): array
    {
        $cardsAsCardEntity = [];

        foreach ($cardsAsArray as $card) {

            if (! is_array($card)) {
                throw new DomainException('All cards must be arrays.');
            }

            $cardsAsCardEntity[] = new static(
                Identity::parse($card['id']),
                new Image($card['image']),
                Name::parse($card['name']),
                $card['intelligence'],
                $card['force'],
                $card['velocity'],
                $card['resistance'],
                $card['fighting'],
                $card['power'],
                $card['overall'],
                $card['createdAt']
            );
        }

        return $cardsAsCardEntity;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->getId(),
            'image' => (string) $this->getImage(),
            'name' => (string) $this->getName(),
            'intelligence' => $this->getIntelligence(),
            'force' => $this->getForce(),
            'velocity' => $this->getVelocity(),
            'resistance' => $this->getResistance(),
            'fighting' => $this->getFighting(),
            'power' => $this->getPower(),
            'overall' => $this->getOverall(),
            'createdAt' => $this->getCreatedAt(),
        ];
    }

    // setters
    public function setId(Identity $id): void
    {
        $this->id = $id;
    }

    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    public function setIntelligence(int $intelligence): void
    {
        $this->intelligence = $intelligence;
    }

    public function setForce(int $force): void
    {
        $this->force = $force;
    }

    public function setVelocity(int $velocity): void
    {
        $this->velocity = $velocity;
    }

    public function setResistance(int $resistance): void
    {
        $this->resistance = $resistance;
    }

    public function setFighting(int $fighting): void
    {
        $this->fighting = $fighting;
    }

    public function setPower(int $power): void
    {
        $this->power = $power;
    }

    public function setOverall(int $overall): void
    {
        $this->overall = $overall;
    }

    // getters
    public function getId(): Identity
    {
        return $this->id;
    }

    public function getImage(): Image
    {
        return $this->image;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    public function getForce(): int
    {
        return $this->force;
    }

    public function getVelocity(): int
    {
        return $this->velocity;
    }

    public function getResistance(): int
    {
        return $this->resistance;
    }

    public function getFighting(): int
    {
        return $this->fighting;
    }

    public function getPower(): int
    {
        return $this->power;
    }

    public function getOverall(): int
    {
        return $this->overall;
    }
}
