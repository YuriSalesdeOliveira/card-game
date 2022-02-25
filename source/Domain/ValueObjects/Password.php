<?php

namespace Source\Domain\ValueObjects;

use DomainException;

final class Password
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function value(): string
    {
        return $this->password;
    }

    public static function parse(string $password): Password
    {
        self::validate($password);

        return new self($password);
    }

    private static function validate(string $password): void
    {
        if (strlen($password) < 8) {
            throw new DomainException('Password is invalid. Must be greater than 8.');
        }
    }

    public function verify(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function hash(): Password
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return $this;
    }

    public function __toString(): string
    {
        return $this->password;
    }
}