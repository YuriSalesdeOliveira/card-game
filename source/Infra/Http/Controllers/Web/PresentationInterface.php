<?php

namespace Source\Infra\Http\Controllers\Web;

interface PresentationInterface
{
    public function output(array $data): mixed;
}