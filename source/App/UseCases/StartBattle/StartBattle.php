<?php

namespace Source\App\UseCases\StartBattle;

use Source\Domain\Entities\Battle;
use Source\Domain\Entities\CardCollection;
use Source\Domain\Repositories\GetCardRepositoryInterface;

class StartBattle
{
    public function __construct(
        private GetCardRepositoryInterface $getCardRepository
    ) {}

    public function handle(InputBoundary $input): OutputBoundary
    {
        $playerCards = $this->getCardRepository->getCardsById($input->getCardIds());
        $machineCards = $this->getCardRepository->getRandomCards(Battle::LIMIT_CARDS);

        $playerCardCollection = new CardCollection($playerCards);
        $machineCardCollection = new CardCollection($machineCards);

        $battle = new Battle(
            $playerCardCollection,
            $machineCardCollection,
            roundResults: [],
            lastRound: Battle::LIMIT_CARDS,
            round: 1,
            defeatedCards: []
        );

        return new OutputBoundary($battle->toArray());
    }
}