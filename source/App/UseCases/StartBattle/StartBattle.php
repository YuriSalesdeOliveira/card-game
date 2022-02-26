<?php

namespace Source\App\UseCases\StartBattle;

use Source\Domain\ValueObjects\Identity;
use Source\Domain\Repositories\GetCardRepositoryInterface;
use Source\Domain\Repositories\GetPlayerRepositoryInterface;
use Source\Domain\Repositories\GetPlayerCardIdsRepositoryInterface;

class StartBattle
{
    public function __construct(
        private GetPlayerRepositoryInterface $getPlayerRepository,
        private GetPlayerCardIdsRepositoryInterface $getPlayerCardIdsRepository,
        private GetCardRepositoryInterface $getCardRepository
    ) {}

    public function handle(InputBoundary $input): OutputBoundary
    {
        $player = $this->getPlayerRepository->getPlayerById(new Identity($input->getId()));

        $cardIds = $this->getPlayerCardIdsRepository->getPlayerCardIds($player);

        $cards = [];

        foreach ($cardIds as $cardId)
        {
            $card = $this->getCardRepository->getCardById(new Identity($cardId));

            array_push($cards, $card->toArray());
        }
        
        return new OutputBoundary($cards);
    }
}