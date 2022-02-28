<?php

namespace Source\Domain\Entities;

use DomainException;

class CardCollection extends Entity
{
    const NUMBER_OF_CARDS_FOR_BATTLE = 2;

    public function __construct(array $cardCollection, bool $countCards = true)
    {   
        $this->setCollection($cardCollection, $countCards);
    }

    public function toArray(): array
    {
        $cardCollection = [];

        foreach ($this->attributes['cardCollection'] as $card) {
            $cardCollection[] = $card->toArray();
        }

        return $cardCollection;
    }

    public function setCollection(array $cardCollection, bool $countCards = true): void
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
        
        $this->attributes['cardCollection'] = $cardCollection;

    }

    public function getCollection(): array
    {
        return $this->attributes['cardCollection'];
    }
}