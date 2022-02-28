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
            'image' => 'http://localhost/cardGame/assets/images/cards/blackPanther.png',
            'name' => 'Wolverine',
            'intelligence' => 45,
            'force' => 50,
            'velocity' => 50,
            'resistance' => 75,
            'fighting' => 80,
            'power' => 80,
            'overall' => 380,
            'createdAt' => '2022-02-24 21:07:56'
        ],
        [
            'id' => 'c6c6b47581155db3b410b5de404a7755',
            'image' => 'http://localhost/cardGame/assets/images/cards/nightcrawler.jpeg',
            'name' => 'Wolverine',
            'intelligence' => 45,
            'force' => 50,
            'velocity' => 50,
            'resistance' => 75,
            'fighting' => 80,
            'power' => 80,
            'overall' => 380,
            'createdAt' => '2022-02-24 21:07:56'
        ],
        [
            'id' => '38d1ef4371fecfc1df5ab7cd895ffab9',
            'image' => 'http://localhost/cardGame/assets/images/cards/mysterio.jpeg',
            'name' => 'Wolverine',
            'intelligence' => 45,
            'force' => 50,
            'velocity' => 50,
            'resistance' => 75,
            'fighting' => 80,
            'power' => 80,
            'overall' => 380,
            'createdAt' => '2022-02-24 21:07:56'
        ],
        [
            'id' => '5a8b297c8078b5de394707bef47cd3bf',
            'image' => 'http://localhost/cardGame/assets/images/cards/mysterio.jpeg',
            'name' => 'Wolverine',
            'intelligence' => 45,
            'force' => 50,
            'velocity' => 50,
            'resistance' => 75,
            'fighting' => 80,
            'power' => 80,
            'overall' => 380,
            'createdAt' => '2022-02-24 21:07:56'
        ],
        [
            'id' => '16404025c29660241cbbdebcfcbb281f',
            'image' => 'http://localhost/cardGame/assets/images/cards/blackPanther.png',
            'name' => 'Wolverine',
            'intelligence' => 45,
            'force' => 50,
            'velocity' => 50,
            'resistance' => 75,
            'fighting' => 80,
            'power' => 80,
            'overall' => 380,
            'createdAt' => '2022-02-24 21:07:56'
        ],
    ];

    public function getCardById(Identity $id): Card
    {
        foreach ($this->cards as $card) {
            if ($card['id'] === $id->value()) { 
                return new Card(
                    id: new Identity($card['id']),
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

    public function getCardsById(array $ids): array
    {
        $cards = [];
        
        foreach ($ids as $id) {
            $cards[] = $this->getCardById(new Identity($id));
        }

        return $cards;
    }

    public function getRandomCards(int $limit): array
    {
        $cardIndexes = array_rand($this->cards, $limit);
        
        $cardIds = [];

        foreach ($cardIndexes as $index) {
            $cardIds[] = $this->cards[$index]['id'];
        }
        
        $cards = $this->getCardsById($cardIds);

        return $cards;
    }
}