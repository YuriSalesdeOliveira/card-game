<?php

namespace Source\App\UseCases\ToBattle;

use Source\Domain\Entities\Card;
use Source\Domain\Entities\Battle;
use Source\Domain\Entities\CardCollection;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\ValueObjects\Status;

class ToBattle
{
    public function handle(InputBoundary $input): OutputBoundary
    {
        $inputBattle = $input->getBattle();

        $playerCardCollection = Card::toCard($inputBattle['playerCardCollection']);
        $machineCardCollection = Card::toCard($inputBattle['machineCardCollection']);

        $defeatedCards = [];

        foreach ($inputBattle['defeatedCards'] as $owner => $cardIds) {
            foreach ($cardIds as $cardId) {
                $defeatedCards[$owner][] = new Identity($cardId);
            }
        }

        $battle = new Battle(
            Status::parse($inputBattle['status']),
            new CardCollection($playerCardCollection),
            new CardCollection($machineCardCollection),
            $inputBattle['roundResults'],
            $inputBattle['round'],
            $defeatedCards
        );
        
        $battle->toBattle(Identity::parse($input->getCardToBattleId()));

        return new OutputBoundary($battle->toArray());
    }
}