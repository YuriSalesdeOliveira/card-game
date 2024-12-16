<?php

namespace Source\App\UseCases\StartBattle;

use Source\Domain\Entities\Battle;
use Source\Domain\Entities\CardCollection;
use Source\Domain\Enums\StatusBattle;
use Source\Domain\Repositories\Card\GetCardRepositoryInterface;
use Source\Domain\ValueObjects\Identity;

readonly class StartBattle
{
    public function __construct(
        private GetCardRepositoryInterface $getCardRepository
    ) {}

    public function handle(InputBoundary $input): OutputBoundary
    {   // Warning: melhorar nome dessa variavel
        $numberOfCardsForBattle = Battle::LIMIT_ROUNDS;

        $cardIds = Identity::parseAll($input->getCardIds());

        $playerCards = $this->getCardRepository->getCardsById($cardIds);
        $machineCards = $this->getCardRepository->getRandomCards($numberOfCardsForBattle);

        $playerCardCollection = new CardCollection($playerCards, $numberOfCardsForBattle);
        $machineCardCollection = new CardCollection($machineCards, $numberOfCardsForBattle);

        $battle = new Battle(
            StatusBattle::STARTED,
            $playerCardCollection,
            $machineCardCollection,
            resultOfRounds: [],
            round: 0,
            defeatedCardIds: []
        );

        return new OutputBoundary($battle->toArray());
    }
}
