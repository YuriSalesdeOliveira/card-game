<?php

namespace Source\Domain\Entities;

use Source\domain\Entities\Entity;
use Source\Domain\ValueObjects\Status;

class Battle extends Entity
{
    private Status $status;

    public function __construct(
        private CardCollection $playerCardCollection,
        private CardCollection $machineCardCollection,
        private array $roundResults,
        private int $lastRound,
        private int $round
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
            'round' => $this->getRound()
        ];
    }

    public function toBattle(): Battle
    {

        $playerCard = $this->playerCardCollection[$this->round];
        $machineCard = $this->machineCardCollection[$this->round];

        $sumOverall = $playerCard->getOverall() + $machineCard->getOverall();

        $randNumber = rand(0, $sumOverall);

        if ($randNumber <= $playerCard->getOverall()) {
            $this->addWinner('player');
        }
        
        if ($randNumber <= $sumOverall) {
            $this->addWinner('machine');
        }

        if ($this->getRound() === $this->getLastRound()) {

            $this->setStatus(Status::parse(Status::FINISHED));

            return $this;
        }

        $this->addRound();

        return $this;
    }

    private function addRound()
    {
        $this->round++;

        return $this->round;
    }

    private function addWinner($winner): void
    {
        $this->roundResults[] = [$winner = true];
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
}