<?php

namespace Source\Domain\Enums;

enum StatusBattle: int
{
    case STARTED = 801;
    case FINISHED = 802;

    public function isStarted(): bool
    {
        return $this === self::STARTED;
    }

    public function isFinished(): bool
    {
        return $this === self::FINISHED;
    }
}
