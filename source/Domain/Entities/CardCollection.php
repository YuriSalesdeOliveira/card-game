<?php

namespace Source\Domain\Entities;

use DomainException;

class CardCollection extends Entity
{
    const CARD_LIMIT = 2;

    public function __construct(array $collection)
    {   
        $this->setCollection($collection);
    }

    public function toArray(): array
    {
        $cardCollection = [];

        foreach ($this->attributes['collection'] as $card) {
            $cardCollection[] = $card->toArray();
        }

        return $cardCollection;
    }

    public function setCollection(array $collection): void
    {
        if (count($collection) !== static::CARD_LIMIT) {
            throw new DomainException(
                sprintf('The number of cards must be equal to %s', static::CARD_LIMIT)
            );
        }

        foreach ($collection as $card) {
            if (!($card instanceof Card)) {
                throw new DomainException('All cards must be an instance of the card entity.');
            }

            $this->attributes['collection'][] = $card;
        }

    }

    public function getCollection(): array
    {
        return $this->attributes['collection'];
    }
}