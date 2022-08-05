<?php

namespace Source\Infra\Repositories\Memory;

use DateTimeImmutable;
use Source\Domain\Entities\Player;
use Source\Domain\ValueObjects\Email;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\ValueObjects\Password;
use Source\Domain\Repositories\Player\GetPlayerRepositoryInterface;
use Source\Domain\Repositories\Player\GetPlayerCardIdsRepositoryInterface;

class PlayerRepository implements GetPlayerRepositoryInterface, GetPlayerCardIdsRepositoryInterface
{
    private array $players = [
        [
            'id' => 'b0783a1f6d678676111ba958db3ae9db',
            'email' => 'yuri_oli@hotmail.com',
            'password' => '$2y$10$rZQ1t4riobGIEG6cjqdqMeYkMnC8kx/ljAl1vDx5QjXhn19jmTsZG',
            'createdAt' => '2022-02-24 21:07:56',
        ]
    ];

    private array $playerCardIds = [
        'b0783a1f6d678676111ba958db3ae9db' => [
            '92216f3a776a0365fc24fcf2d88dfe21',
            'c6c6b47581155db3b410b5de404a7755',
            '38d1ef4371fecfc1df5ab7cd895ffab9',
            '5a8b297c8078b5de394707bef47cd3bf',
            '16404025c29660241cbbdebcfcbb281f'
        ]
    ];

    public function getPlayerById(Identity $id): Player|false
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

        return false;
    }

    public function getPlayerCardIds(Player $player): array|false
    {
        foreach ($this->playerCardIds as $playerId => $cardIds) {

            if ($playerId === $player->getId()->value()) {

                $cardIdsAsIdentity = [];

                foreach ($cardIds as $cardId) {
                    $cardIdsAsIdentity[] = Identity::parse($cardId);
                }

                return $cardIdsAsIdentity;
            }
        }

        return false;
    }
}