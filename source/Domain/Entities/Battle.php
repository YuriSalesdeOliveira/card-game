<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\Domain\Enums\StatusBattle;
use Source\Domain\ValueObjects\Identity;

class Battle extends Entity
{
    const LIMIT_ROUNDS = 3;

    public function __construct(
        private StatusBattle            $statusBattle,
        private readonly CardCollection $playerCardCollection,
        private readonly CardCollection $machineCardCollection,
        private array                   $resultOfRounds,
        private int                     $round,
        private array                   $defeatedCardIds
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

        $battleToArray = [
            'statusBattle' => $this->getStatusBattle(),
            'playerCardCollection' => $this->getPlayerCardCollection()->toArray(),
            'machineCardCollection' => $this->getMachineCardCollection()->toArray(),
            'resultOfRounds' => $this->getResultOfRounds(),
            'round' => $this->getRound(),
            'defeatedCardIds' => $defeatedCardIds
        ];

        if ($this->getStatusBattle()->isFinished()) {
            $battleToArray['battleWinner'] = $this->getBattleWinner();
        }

        return $battleToArray;
    }

    public function toBattle(Identity $playerCardId): void
    {
        if ($this->getStatusBattle()->isFinished()) {
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
            $this->setStatusBattle(StatusBattle::FINISHED);
        }
    }

    // Danger: melhorar logica e retorno para ter mais informacoes
    public function getBattleWinner(): string
    {
        if (!$this->getStatusBattle()->isFinished()) {
            throw new DomainException(
                'It is not possible to get a winner before the battle is over.'
            );
        }

        $roundWinnerResults = array_column($this->getResultOfRounds(), 'roundWinner');
        ['player' => $playerResult, 'machine' => $machineResult] = array_count_values($roundWinnerResults);

        if ($playerResult === $machineResult) {
            return 'nobody';
        }

        return match (max($playerResult, $machineResult)) {
            $playerResult => 'player',
            $machineResult => 'machine',
        };
    }

    private function isDefeatedCard(string $owner, Identity $cardId): bool
    {
        $defeatedCardIds = $this->getDefeatedCardIds();

        if (isset($defeatedCardIds[$owner])) {

            if (in_array($cardId, $defeatedCardIds[$owner])) {
                return true;
            }
        }

        return false;
    }

    private function addDefeatedCard(string $owner, Identity $cardId): void
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

    // setters
    private function setStatusBattle(StatusBattle $statusBattle): void
    {
        $this->statusBattle = $statusBattle;
    }

    // getters
    public function getStatusBattle(): StatusBattle
    {
        return $this->statusBattle;
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

            return $defeatedCardIds[$owner] ?? [];
        }

        return $defeatedCardIds;
    }
}
