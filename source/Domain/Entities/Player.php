<?php

namespace Source\Domain\Entities;

use DateTimeInterface;
use Source\Domain\ValueObjects\Email;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\ValueObjects\Password;

class Player extends Entity
{
    public function __construct(
        private Identity $id,
        private Email $email,
        private Password $password,
        protected DateTimeInterface $createdAt
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->getId(),
            'email' => (string) $this->getEmail(),
            'password' => (string) $this->getPassword(),
            'createdAt' => $this->getCreatedAt(),
        ];
    }

    // setters
    public function setId(Identity $id): void
    {
        $this->id = $id;
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function setPassword(Password $password): void
    {
        $this->password = $password;
    }

    // getters
    public function getId(): Identity
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }
}
