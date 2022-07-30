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

        $defeatedCardIds = [];

        foreach ($inputBattle['defeatedCardIds'] as $owner => $cardIds) {
            foreach ($cardIds as $cardId) {
                $defeatedCardIds[$owner][] = new Identity($cardId);
            }
        }

        $battle = new Battle(
            Status::parse($inputBattle['status']),
            new CardCollection($playerCardCollection),
            new CardCollection($machineCardCollection),
            $inputBattle['resultOfRounds'],
            $inputBattle['round'],
            $defeatedCardIds
        );
        
        $battle->toBattle(Identity::parse($input->getCardToBattleId()));

        return new OutputBoundary($battle->toArray());
    }
}