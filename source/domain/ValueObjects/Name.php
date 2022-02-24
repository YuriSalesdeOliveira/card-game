<?php

namespace Source\domain\ValueObjects;

use DomainException;

final class Name
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function parse(string $name): Name
    {
        self::validate($name);

        return new self($name);
    }

    private static function validate(string $name): void
    {
        if (empty($name)) {
            throw new DomainException('Name is invalid.');
        }
    }

    public function __toString(): string
    {
        return $this->name;
    }
}