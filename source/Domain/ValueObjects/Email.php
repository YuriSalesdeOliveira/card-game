<?php

namespace Source\Domain\ValueObjects;

use DomainException;

final class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public static function parse(string $email): Email
    {
        self::validate($email);

        return new self($email);
    }

    private static function validate(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new DomainException('Email is not valid.');
        }
    }

    public function __toString(): string
    {
        return $this->email;
    }
}