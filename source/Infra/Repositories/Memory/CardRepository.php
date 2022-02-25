<?php

namespace Source\Infra\Repositories\Memory;

use DateTimeImmutable;
use Source\Domain\Entities\Card;
use Source\Domain\ValueObjects\Name;
use Source\Domain\ValueObjects\Image;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\Repositories\GetCardRepositoryInterface;

class CardRepository implements GetCardRepositoryInterface
{
    private array $cards = [
        [
            'id' => '92216f3a776a0365fc24fcf2d88dfe21',
            'image' => 'https://i.pinimg.com/564x/ff/7d/bf/ff7dbfbbf11eff9527b9b5a53a8e52ed.jpg',
            'name' => 'Wolverine',
            'intelligence' => 45,
            'force' => 50,
            'velocity' => 50,
            'resistance' => 75,
            'fighting' => 80,
            'power' => 80,
            'overall' => 380,
            'createdAt' => '2022-02-24 21:07:56'
        ]
    ];

    public function getCardById(Identity $id): Card
    {
        foreach ($this->cards as $card) {
            if ($card['id'] === $id->value()) { 
                return new Card(
                    id: $id,
                    image: new Image($card['image']),
                    name: new Name($card['name']),
                    intelligence: $card['intelligence'],
                    force: $card['force'],
                    velocity: $card['velocity'],
                    resistance: $card['resistance'],
                    fighting: $card['fighting'],
                    power: $card['power'],
                    overall: $card['overall'],
                    createdAt: new DateTimeImmutable($card['createdAt'])
                );
            }
        }
    }
}