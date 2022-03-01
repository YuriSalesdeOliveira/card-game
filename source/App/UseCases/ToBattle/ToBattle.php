<?php

namespace Source\App\UseCases\ToBattle;

class ToBattle
{
    public function handle(InputBoundary $input): OutputBoundary
    {
        return new OutputBoundary();
    }
}