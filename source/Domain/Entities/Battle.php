<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\ValueObjects\Status;

class Battle extends Entity
{
    private Status $status;

    public function __construct(
        private CardCollection $playerCardCollection,
        private CardCollection $machineCardCollection,
        private array $roundResults,
        private int $lastRound,
        private int $round,
        private array $lostCards
    ) {
        $this->setStatus(Status::parse(Status::STARTED));
    }

    public function toArray(): array
    {
        return [
            'status' => (string) $this->getStatus(),
            'playerCardCollection' => $this->getPlayerCardCollection()->toArray(),
            'machineCardCollection' => $this->getMachineCardCollection()->toArray(),
            'roundResults' => $this->getRoundResults(),
            'lastRound' => $this->getLastRound(),
            'round' => $this->getRound(),
            'lostCards' => $this->getLostCards()
        ];
    }

    public function toBattle(Identity $cardId): Battle
    {
        if ($this->getRound() > $this->getLastRound()) {

            $this->setStatus(Status::parse(Status::FINISHED));

            return $this;
        }

        $playerCard = $this->playerCardCollection->getCardById($cardId);
        $machineCard = $this->machineCardCollection->getCardCollection()[$this->round - 1];

        $sumOverall = $playerCard->getOverall() + $machineCard->getOverall();

        $randNumber = rand(0, $sumOverall);

        if ($randNumber <= $playerCard->getOverall()) {

            $this->addWinner('player');

        } elseif ($randNumber <= $sumOverall) {

            $this->addWinner('machine');

            $playerCard = $this->playerCardCollection->deleteCardById($cardId);

            $this->addLostCard($cardId);

        }

        $this->addRound();

        return $this;
    }

    private function addLostCard(Identity $cardId)
    {
        $this->lostCards[] = $cardId;
    }

    private function addRound()
    {
        $this->round++;

        return $this->round;
    }

    private function addWinner(string $winner): void
    {
        $this->roundResults[] = [$winner => true];
    }

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
    public function getLostCards(): array
    {
        return $this->lostCards;
    }
}