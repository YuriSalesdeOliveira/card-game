<?php

namespace Source\Infra\Http\Controllers\Web;

interface PresenterInterface
{
    public function output(array $data): mixed;
}
