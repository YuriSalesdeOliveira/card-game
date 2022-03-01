<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\Domain\ValueObjects\Identity;

class CardCollection extends Entity
{
    private array $cardCollection;

    const NUMBER_OF_CARDS_FOR_BATTLE = 2;

    public function __construct(array $cardCollection, bool $countCards = true)
    {   
        $this->setCardCollection($cardCollection, $countCards);
    }

    public function toArray(): array
    {
        $cardCollection = [];

        foreach ($this->cardCollection as $card) {
            $cardCollection[] = $card->toArray();
        }

        return $cardCollection;
    }

    public function setCardCollection(array $cardCollection, bool $countCards = true): void
    {
        foreach ($cardCollection as $card) {
            if (!($card instanceof Card)) {
                throw new DomainException('All cards must be an instance of the card entity.');
            }
        }

        if ($countCards) {
            if (count($cardCollection) !== static::NUMBER_OF_CARDS_FOR_BATTLE) {
                throw new DomainException(
                    sprintf('The number of cards must be equal to %s', static::NUMBER_OF_CARDS_FOR_BATTLE)
                );
            }
        }
        
        $this->cardCollection = $cardCollection;

    }

    public function getCardById(Identity $cardId): Card
    {
        foreach ($this->cardCollection as $card) {
            if ($card->getId() == $cardId) {
                return $card;
            }
        }

        throw new DomainException('The card id is invalid.');
    }

    public function deleteCardById(Identity $cardId): bool
    {
        foreach ($this->cardCollection as $index => $card) {
            if ($card->getId() == $cardId) {
                unset($this->cardCollection[$index]);
                return true;
            }
        }

        throw new DomainException('The card id is invalid.');
    }

    public function getCardCollection(): array
    {
        return $this->cardCollection;
    }
}