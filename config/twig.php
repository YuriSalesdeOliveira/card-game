<?php

use Twig\TwigFunction;

return [
    new TwigFunction(
        'assets',
        function ($asset) { return app('site.root') . "/assets/{$asset}"; }
    ),
];