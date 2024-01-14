<?php

use Twig\TwigFunction;

return [
    new TwigFunction(
        'assets',
        fn (string $asset): string => app('site.root')."/assets/{$asset}"
    ),
];
