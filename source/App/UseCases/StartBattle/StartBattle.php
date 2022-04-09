<?php

namespace Source\App\UseCases\StartBattle;

use Source\Domain\Entities\Battle;
use Source\Domain\Entities\CardCollection;
use Source\Domain\Repositories\GetCardRepositoryInterface;
use Source\Domain\ValueObjects\Status;

class StartBattle
{
    public function __construct(
        private GetCardRepositoryInterface $getCardRepository
    ) {}

    public function handle(InputBoundary $input): OutputBoundary
    {
        $playerCards = $this->getCardRepository->getCardsById($input->getCardIds());
        $machineCards = $this->getCardRepository->getRandomCards(Battle::LIMIT_ROUNDS);

        $playerCardCollection = new CardCollection($playerCards);
        $machineCardCollection = new CardCollection($machineCards);

        $battle = new Battle(
            Status::parse(Status::STARTED),
            $playerCardCollection,
            $machineCardCollection,
            roundResults: [],
            round: 0,
            defeatedCards: []
        );

        return new OutputBoundary($battle->toArray());
    }
}