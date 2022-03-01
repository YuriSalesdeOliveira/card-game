<?php

namespace Source\App\UseCases\SelectCardCollection;

use Source\Domain\Entities\CardCollection;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\Repositories\GetCardRepositoryInterface;
use Source\Domain\Repositories\GetPlayerRepositoryInterface;
use Source\Domain\Repositories\GetPlayerCardIdsRepositoryInterface;

class SelectCardCollection
{
    public function __construct(
        private GetPlayerRepositoryInterface $getPlayerRepository,
        private GetPlayerCardIdsRepositoryInterface $getPlayerCardIdsRepository,
        private GetCardRepositoryInterface $getCardRepository
    ) {}

    public function handle(InputBoundary $input): OutputBoundary
    {
        $player = $this->getPlayerRepository->getPlayerById(new Identity($input->getId()));// getPlyerId

        $cardIds = $this->getPlayerCardIdsRepository->getPlayerCardIds($player);

        $cards = $this->getCardRepository->getCardsById($cardIds);
        
        $cardCollection = new CardCollection($cards, countCards: false);

        return new OutputBoundary($cardCollection->toArray());
    }
}