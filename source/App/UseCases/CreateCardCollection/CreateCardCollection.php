<?php

namespace Source\App\UseCases\CreateCardCollection;

use Source\Domain\Entities\CardCollection;
use Source\Domain\Repositories\GetCardRepositoryInterface;

class CreateCardCollection
{
    public function __construct(
        private GetCardRepositoryInterface $getCardRepository
    ) {}

    public function handle(InputBoundary $input): OutputBoundary
    {
        $playerCards = $this->getCardRepository->getCardsById($input->getCardIds());
        $machineCards = $this->getCardRepository->getRandomCards(
            CardCollection::NUMBER_OF_CARDS_FOR_BATTLE
        );

        $playerCardCollection = new CardCollection($playerCards);
        $machineCardCollection = new CardCollection($machineCards);

        return new OutputBoundary($playerCardCollection->toArray(), $machineCardCollection->toArray());
    }
}