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

    public function setCollection(array $collection): void
    {
        if (count($collection) !== static::CARD_LIMIT) {
            throw new DomainException('The number of cards cannot be greater than 10.');
        }

        $this->attributes['collection'] = $collection;
    }

    public function getCollection(): array
    {
        return $this->attributes['collection'];
    }
}