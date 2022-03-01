<?php

namespace Source\App\UseCases\ToBattle;

use Source\Domain\Entities\Card;
use Source\Domain\Entities\Battle;
use Source\Domain\Entities\CardCollection;
use Source\Domain\ValueObjects\Identity;

class ToBattle
{
    public function handle(InputBoundary $input): OutputBoundary
    {
        $inputBattle = $input->getBattle();

        $playerCardCollection = Card::toCard($inputBattle['playerCardCollection']);
        $machineCardCollection = Card::toCard($inputBattle['machineCardCollection']);

        $battle = new Battle(
            playerCardCollection: new CardCollection($playerCardCollection, false),
            machineCardCollection: new CardCollection($machineCardCollection),
            roundResults: $inputBattle['roundResults'],
            lastRound: $inputBattle['lastRound'],
            round: $inputBattle['round'],
            lostCards: $inputBattle['lostCards']
        );

        $battle->toBattle(Identity::parse($input->getCardToBattleId()));

        return new OutputBoundary($battle->toArray());
    }
}