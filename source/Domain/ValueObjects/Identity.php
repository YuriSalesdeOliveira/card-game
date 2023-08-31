<?php

namespace Source\Domain\ValueObjects;

use DomainException;

final class Identity
{
    private string $identity;

    public function __construct(string $identity)
    {
        $this->identity = $identity;
    }

    public function value(): string
    {
        return $this->identity;
    }

    public static function parse(string $identity): Identity
    {
        self::validate($identity);

        return new self($identity);
    }

    public static function parseAll(array $identities): array
    {
        $parsedIdentities = [];

        foreach ($identities as $identity) {
            $parsedIdentities[] = self::parse($identity);
        }

        return $parsedIdentities;
    }

    public static function generate(): Identity
    {
        $identity = md5(uniqid());

        return new self($identity);
    }

    private static function validate(string $identity): void
    {
        if (empty($identity)) {
            throw new DomainException('Identity is invalid.');
        }
    }

    public function __toString(): string
    {
        return $this->identity;
    }
}
