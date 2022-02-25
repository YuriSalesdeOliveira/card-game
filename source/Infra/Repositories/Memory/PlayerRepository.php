<?php

namespace Source\Infra\Repositories\Memory;

use DateTimeImmutable;
use Source\Domain\Entities\Player;
use Source\Domain\Repositories\GetPlayerCardsRepositoryInterface;
use Source\Domain\ValueObjects\Email;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\ValueObjects\Password;
use Source\Domain\Repositories\GetPlayerRepositoryInterface;

class PlayerRepository implements GetPlayerRepositoryInterface, GetPlayerCardsRepositoryInterface
{
    private array $players = [
        [
            'id' => 'b0783a1f6d678676111ba958db3ae9db',
            'email' => 'yuri_oli@hotmail.com',
            'password' => '$2y$10$rZQ1t4riobGIEG6cjqdqMeYkMnC8kx/ljAl1vDx5QjXhn19jmTsZG',
            'createdAt' => '2022-02-24 21:07:56',
        ]
    ];

    private array $playerCard = [
        '92216f3a776a0365fc24fcf2d88dfe21'
    ];
    
    public function getPlayerById(Identity $id): Player
    {
        foreach ($this->players as $player) {
            if ($player['id'] === $id->value()) {

                return new Player(
                    id: $id,
                    email: new Email($player['email']),
                    password: new Password($player['password']),
                    createdAt: new DateTimeImmutable($player['createdAt']),
                );
            }
        }
    }

    public function getPlayerCards(Player $player): array
    {
        return $this->playerCard;
    }
}