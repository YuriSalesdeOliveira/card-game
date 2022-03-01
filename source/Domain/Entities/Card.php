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
    ) {
        $this->setId($id);
        $this->setImage($image);
        $this->setName($name);
        $this->setIntelligence($intelligence);
        $this->setForce($force);
        $this->setVelocity($velocity);
        $this->setResistance($resistance);
        $this->setFighting($fighting);
        $this->setPower($power);
        $this->setOverall($overall);
        $this->setCreatedAt($createdAt);
    }

    public static function toCard(array $arrayCards): array
    {
        $cards = [];

        foreach ($arrayCards as $card) {
            $cards[] = new static(
                Identity::parse($card['id']),
                new Image($card['image']),// precisa ser parse
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

        return $cards;
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
            'createdAt' => $this->getCreatedAt()
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