<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\Domain\ValueObjects\Identity;

class CardCollection extends Entity
{
    private array $cards;

    public function __construct(
        array $cards,
        private readonly int|false $numberOfCards = false
    ) {
        $this->setCards($cards);
    }

    public function setCards(array $cards): void
    {
        $this->parseCards($cards);

        $this->cards = $cards;
    }

    private function parseCards(array $cards): void
    {
        $numberOfCards = $this->numberOfCards;

        if ($numberOfCards) {
            if (count($cards) !== $numberOfCards) {
                throw new DomainException(
                    sprintf('The number of cards must be equal to %s', $numberOfCards)
                );
            }
        }

        foreach ($cards as $card) {
            if (! ($card instanceof Card)) {
                throw new DomainException('All cards must be an instance of the card entity.');
            }
        }
    }

    public function toArray(): array
    {
        $cards = [];

        foreach ($this->cards as $card) {
            $cards[] = $card->toArray();
        }

        return $cards;
    }

    public function getRandomCard(array $idsNotAllowed = []): Card
    {
        $randomIndex = array_rand($this->cards);
        $card = $this->cards[$randomIndex];

        if ($idsNotAllowed) {

            foreach ($idsNotAllowed as $idNotAllowed) {

                if (! ($idNotAllowed instanceof Identity)) {
                    throw new DomainException('The elements in idsNotAllowed must be an identity instance.');
                }

                if ($card->getId() == $idNotAllowed) {

                    return $this->getRandomCard($idsNotAllowed);
                }
            }
        }

        return $card;
    }

    public function getCardById(Identity $cardId): Card
    {
        foreach ($this->cards as $card) {
            if ($card->getId() == $cardId) {
                return $card;
            }
        }

        throw new DomainException('The card id is invalid.');
    }

    public function removeCardById(Identity $cardId): bool
    {
        foreach ($this->cards as $index => $card) {
            if ($card->getId() == $cardId) {
                unset($this->cards[$index]);

                return true;
            }
        }

        throw new DomainException('The card id is invalid.');
    }
}
