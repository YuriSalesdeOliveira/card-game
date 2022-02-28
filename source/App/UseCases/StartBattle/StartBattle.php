<?php

namespace Source\App\UseCases\StartBattle;

class StartBattle
{
    public function handle(InputBoundary $input): OutputBoundary
    {
        return new OutputBoundary();
    }
}