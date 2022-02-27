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
        $cards = $this->getCardRepository->getCardsById($input->getCardIds());

        $cardCollection = new CardCollection($cards);

        return new OutputBoundary($cardCollection->toArray());
    }
}