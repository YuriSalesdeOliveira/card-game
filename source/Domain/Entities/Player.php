<?php

namespace Source\Domain\Entities;

use DateTimeInterface;
use Source\Domain\ValueObjects\Email;
use Source\Domain\ValueObjects\Identity;
use Source\Domain\ValueObjects\Password;

class Player extends Entity
{
    public function __construct(
        Identity $id,
        Email $email,
        Password $password,
        DateTimeInterface $createdAt,
    ) {
        $this->attributes = [
            'id' => $id,
            'email' => $email,
            'password' => $password,
            'createdAt' => $createdAt,
        ];
    }
    
    public function toArray(): array
    {
        return [];
    }
    // setters
    public function setId(Identity $id): void
    {
        $this->attributes['id'] = $id;
    }
    public function setEmail(Email $email): void
    {
        $this->attributes['email'] = $email;
    }
    public function setPassword(Password $password): void
    {
        $this->attributes['password'] = $password;
    }
    // getters
    public function getId(): Identity
    {
        return $this->attributes['id'];
    }
    public function getEmail(): Email
    {
        return $this->attributes['email'];
    }
    public function getPassword(): Password
    {
        return $this->attributes['password'];
    }
}