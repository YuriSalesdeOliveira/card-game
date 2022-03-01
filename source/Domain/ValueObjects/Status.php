<?php

namespace Source\Domain\ValueObjects;

use DomainException;

class Status
{
    private string $status;
    private static array $allowedStatus = [
        23400 => 'started',
        23500 => 'finished'
    ];

    const STARTED = 23400;
    const FINISHED = 23500;

    public function __construct(int $status)
    {
        $this->status = self::$allowedStatus[$status];
    }

    public static function parse(int $status): Status
    {
        self::validate($status);

        return new self($status);
    }

    private static function validate(int $status): void
    {
        if (!array_key_exists($status, self::$allowedStatus)) {
            throw new DomainException('Status is not valid.');
        }
    }

    public function __toString(): string
    {
        return $this->status;
    }
}