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
    {   // Warning: melhorar nome dessa variavel
        $numberOfCardsForBattle = Battle::LIMIT_ROUNDS;

        $playerCards = $this->getCardRepository->getCardsById($input->getCardIds());
        $machineCards = $this->getCardRepository->getRandomCards($numberOfCardsForBattle);

        $playerCardCollection = new CardCollection($playerCards, $numberOfCardsForBattle);
        $machineCardCollection = new CardCollection($machineCards, $numberOfCardsForBattle);

        $battle = new Battle(
            Status::parse(Status::STARTED),
            $playerCardCollection,
            $machineCardCollection,
            resultOfRounds: [],
            round: 0,
            defeatedCardIds: []
        );

        return new OutputBoundary($battle->toArray());
    }
}