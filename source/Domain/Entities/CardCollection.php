<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\domain\Entities\Entity;

class CardCollection extends Entity
{
    const CARD_LIMIT = 10;

    public function __construct(array $collection)
    {   
        $this->setCollection($collection);
    }

    public function toArray(): array
    {
        return [];
    }

    public function setCollection(array $collection): void
    {
        if (count($collection) !== static::CARD_LIMIT) {
            throw new DomainException(
                sprintf('The number of cards must be equal to %s', static::CARD_LIMIT)
            );
        }

        $this->attributes['collection'] = $collection;
    }

    public function getCollection(): array
    {
        return $this->attributes['collection'];
    }
}