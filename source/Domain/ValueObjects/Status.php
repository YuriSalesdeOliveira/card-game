<?php

namespace Source\Domain\ValueObjects;

use DomainException;

class Status
{
    private int $status;
    private static array $allowedStatus = [
        23400,
        23500
    ];

    const STARTED = 23400;
    const FINISHED = 23500;

    public function __construct(int $status)
    {
        $this->status = $status;
    }

    public function isStarted(): bool
    {
        return $this->status === self::STARTED;
    }

    public function isFinished(): bool
    {
        return $this->status === self::FINISHED;
    }

    public static function parse(int $status): Status
    {
        self::validate($status);

        return new self($status);
    }

    private static function validate(int $status): void
    {
        if (!in_array($status, self::$allowedStatus)) {
            throw new DomainException('Status is not valid.');
        }
    }

    public function value(): int
    {
        return $this->status;
    }

    public function __toString(): string
    {
        return $this->status;
    }
}