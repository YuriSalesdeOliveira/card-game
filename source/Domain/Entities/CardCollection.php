<?php

namespace Source\Domain\Entities;

use DomainException;
use Source\Domain\ValueObjects\Identity;

class CardCollection extends Entity
{
    private array $cardCollection;

    public function __construct(array $cardCollection, int|false $limitCards = false)
    {   
        $this->setCardCollection($cardCollection, $limitCards);
    }

    public function setCardCollection(array $cardCollection, int|false $limitCards = false): void
    {
        if ($limitCards) {
            if (count($cardCollection) !== $limitCards) {
                throw new DomainException(
                    sprintf('The number of cards must be equal to %s', $limitCards)
                );
            }
        }
        
        foreach ($cardCollection as $card) {
            if (!($card instanceof Card)) {
                throw new DomainException('All cards must be an instance of the card entity.');
            }
        }
        
        $this->cardCollection = $cardCollection;
    }

    public function toArray(): array
    {
        $cardCollection = [];

        foreach ($this->cardCollection as $card) {
            $cardCollection[] = $card->toArray();
        }

        return $cardCollection;
    }

    public function getRandomCard(array $idsNotAllowed = []): Card
    {
        $randomIndex = array_rand($this->cardCollection);
        $card = $this->cardCollection[$randomIndex];

        if ($idsNotAllowed) {

            foreach ($idsNotAllowed as $idNotAllowed) {

                if (!($idNotAllowed instanceof Identity)) {
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