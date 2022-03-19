<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\Domain\ValueObjects\Status;
use Source\Domain\ValueObjects\Identity;

class Battle extends Entity
{
    private Status $status;
    private array $defeatedCards = [];

    public function __construct(
        private CardCollection $playerCardCollection,
        private CardCollection $machineCardCollection,
        private array $roundResults,
        private int $lastRound,
        private int $round,
        array $defeatedCards
    ) {
        $this->setStatus(Status::parse(Status::STARTED));
        $this->setDefeatedCards($defeatedCards);
    }

    public function toArray(): array
    {
        $defeatedCards = [];

        foreach ($this->getDefeatedCards() as $owner => $cardIds) {
            foreach ($cardIds as $cardId) {
                $defeatedCards[$owner][] = $cardId->value();
            }
        }

        return [
            'status' => (string) $this->getStatus(),
            'playerCardCollection' => $this->getPlayerCardCollection()->toArray(),
            'machineCardCollection' => $this->getMachineCardCollection()->toArray(),
            'roundResults' => $this->getRoundResults(),
            'lastRound' => $this->getLastRound(),
            'round' => $this->getRound(),
            'defeatedCards' => $defeatedCards
        ];
    }

    public function toBattle(Identity $playerCardId): void
    {
        if ($this->getRound() > $this->getLastRound()) {

            $this->setStatus(Status::parse(Status::FINISHED));

            throw new DomainException('This battle is over.');
        }

        if ($this->isDefeatedCard('player', $playerCardId)) {
            throw new DomainException('This card has already been defeated.');
        }

        $machineCard = $this->machineCardCollection->getRandomCard($this->getDefeatedCards('machine'));
        
        $playerCard = $this->playerCardCollection->getCardById($playerCardId);

        $sumOverall = $playerCard->getOverall() + $machineCard->getOverall();

        $randNumber = rand(0, $sumOverall);

        if ($randNumber <= $playerCard->getOverall()) {

            $this->addWinner('player');

            $this->addDefeatedCard('machine', $machineCard->getId());

        } elseif ($randNumber <= $sumOverall) {

            $this->addWinner('machine');

            $this->addDefeatedCard('player', $playerCardId);
        }

        $this->addRound();
    }

    private function isDefeatedCard(string $owner, Identity $cardId): bool
    {
        if (isset($this->defeatedCards[$owner])) {

            if (in_array($cardId, $this->defeatedCards[$owner])) {
                return true;
            }
        }

        return false;
    }

    private function addDefeatedCard(string $owner, Identity $cardId)
    {
        $this->defeatedCards[$owner][] = $cardId;
    }

    private function addRound()
    {
        $this->round++;

        return $this->round;
    }

    private function addWinner(string $winner): void
    {
        $this->roundResults[] = [
            'round' => $this->getRound(),
            'winner' => $winner
        ];
    }

    // settters
    private function setStatus(Status $status): void
    {
        $this->status = $status;
    }
    private function setDefeatedCards(array $defeatedCards): void
    {
        foreach ($defeatedCards as $owner => $cardIds) {

            foreach ($cardIds as $cardId) {

                if (!($cardId instanceof Identity)) {

                    throw new DomainException(
                        'The elements in defeatedCards must be an identity instance.'
                    );
                }

                $this->defeatedCards[$owner][] = $cardId;
            }
        }
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
    public function getRoundResults(): array
    {
        return $this->roundResults;
    }
    public function getLastRound(): int
    {
        return $this->lastRound;
    }
    public function getRound(): int
    {
        return $this->round;
    }
    public function getDefeatedCards(string $owner = ''): array
    {
        $defeatedCards = $this->defeatedCards;

        if ($owner) {

            return isset($defeatedCards[$owner]) ? $defeatedCards[$owner] : [];
        }

        return $defeatedCards;
    }
}