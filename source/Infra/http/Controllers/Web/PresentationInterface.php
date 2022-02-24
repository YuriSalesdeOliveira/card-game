<?php

namespace Source\Infra\http\Controllers\Web;

interface PresentationInterface
{
    public function output(array $data): mixed;
}