<?php

namespace Source\App\UseCases\StartBattle;

use Source\Domain\Repositories\GetPlayerCardsRepositoryInterface;
use Source\Domain\Repositories\GetPlayerRepositoryInterface;
use Source\Domain\ValueObjects\Identity;

class StartBattle
{
    public function __construct(
        private GetPlayerRepositoryInterface $getPlayerRepository,
        private GetPlayerCardsRepositoryInterface $getPlayerCardsRepository
    ) {}

    public function handle(InputBoundary $input): OutputBoundary
    {
        $player = $this->getPlayerRepository->getPlayerById(new Identity($input->getId()));

        $cards = $this->getPlayerCardsRepository->getPlayerCards($player);

        return new OutputBoundary($cards);
    }
}