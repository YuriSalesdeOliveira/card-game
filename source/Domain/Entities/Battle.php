<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\Domain\ValueObjects\Status;
use Source\Domain\ValueObjects\Identity;

class Battle extends Entity
{
    const LIMIT_ROUNDS = 3;

    public function __construct(
        private Status         $status,
        private CardCollection $playerCardCollection,
        private CardCollection $machineCardCollection,
        private array          $resultOfRounds,
        private int            $round,
        private array          $defeatedCardIds
    )
    {
        $this->parseDefeatedCardIds($this->defeatedCardIds);
    }

    public function toArray(): array
    {
        $defeatedCardIds = [];

        foreach ($this->getDefeatedCardIds() as $owner => $cardIds) {
            foreach ($cardIds as $cardId) {
                $defeatedCardIds[$owner][] = $cardId->value();
            }
        }

        return [
            'status' => $this->getStatus()->value(),
            'playerCardCollection' => $this->getPlayerCardCollection()->toArray(),
            'machineCardCollection' => $this->getMachineCardCollection()->toArray(),
            'resultOfRounds' => $this->getResultOfRounds(),
            'round' => $this->getRound(),
            'defeatedCardIds' => $defeatedCardIds
        ];
    }

    public function toBattle(Identity $playerCardId): void
    {
        if (!$this->status->isStarted()) {
            throw new DomainException('This battle is over.');
        }

        if ($this->isDefeatedCard('player', $playerCardId)) {
            throw new DomainException('This card has already been defeated.');
        }

        $this->addRound();

        $machineCard = $this->machineCardCollection->getRandomCard($this->getDefeatedCardIds('machine'));

        $playerCard = $this->playerCardCollection->getCardById($playerCardId);

        $sumOverall = $playerCard->getOverall() + $machineCard->getOverall();

        $randNumber = rand(0, $sumOverall);

        if ($randNumber <= $playerCard->getOverall()) {

            $this->addRoundWinner('player');

            $this->addDefeatedCard('machine', $machineCard->getId());

        } elseif ($randNumber <= $sumOverall) {

            $this->addRoundWinner('machine');

            $this->addDefeatedCard('player', $playerCardId);
        }

        if ($this->getRound() === static::LIMIT_ROUNDS) {
            $this->setStatus(Status::parse(Status::FINISHED));
        }
    }

    public function getBattleWinner()
    {
        if ($this->getStatus()->value() !== Status::FINISHED) {
            throw new DomainException(
                'It is not possible to get a winner before the battle is over.'
            );
        }

        $player = 0;
        $machine = 0;

        foreach ($this->resultOfRounds as $resultOfRound) {

            $roundWinner = $resultOfRound['roundWinner'];

            switch ($roundWinner) {
                case 'player':
                    $player++;
                    break;
                case 'machine':
                    $machine++;
                    break;
            }
        }

        return $player > $machine ? 'player' : 'machine';
    }

    private function isDefeatedCard(string $owner, Identity $cardId): bool
    {
        if (isset($this->defeatedCardIds[$owner])) {

            if (in_array($cardId, $this->defeatedCardIds[$owner])) {
                return true;
            }
        }

        return false;
    }

    private function addDefeatedCard(string $owner, Identity $cardId)
    {
        $this->defeatedCardIds[$owner][] = $cardId;
    }

    private function addRound(): void
    {
        if ($this->round >= self::LIMIT_ROUNDS) {

            throw new DomainException(
                'It is not possible to exceed the limit of rounds.'
            );
        }

        $this->round++;
    }

    private function addRoundWinner(string $roundWinner): void
    {
        $this->resultOfRounds[] = [
            'round' => $this->getRound(),
            'roundWinner' => $roundWinner
        ];
    }

    private function parseDefeatedCardIds(array $defeatedCardIds): void
    {
        foreach ($defeatedCardIds as $owner => $cardIds) {

            foreach ($cardIds as $cardId) {

                if (!($cardId instanceof Identity)) {

                    throw new DomainException(
                        'The elements in defeatedCardIds must be an identity instance.'
                    );
                }
            }
        }
    }

    // settters
    private function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    //getters
    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getPlayerCardCollection(): CardCollection
    {
        return $this->playerCardCollection;
    }

    public function getMachineCardCollection(): CardCollection
    {
        return $this->machineCardCollection;
    }

    public function getResultOfRounds(): array
    {
        return $this->resultOfRounds;
    }

    public function getRound(): int
    {
        return $this->round;
    }

    public function getDefeatedCardIds(string $owner = ''): array
    {
        $defeatedCardIds = $this->defeatedCardIds;

        if ($owner) {

            return isset($defeatedCardIds[$owner]) ? $defeatedCardIds[$owner] : [];
        }

        return $defeatedCardIds;
    }
}