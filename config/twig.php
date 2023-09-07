<?php

use Twig\TwigFunction;

return [
    new TwigFunction(
        'assets',
        fn ($asset) => app('site.root')."/assets/{$asset}"
    ),
];
