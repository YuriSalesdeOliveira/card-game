<?php

use Twig\TwigFunction;

return [
    new TwigFunction(
        'assets',
        function (string $asset) {
            $url = app('site.root');

            if ($basePath = app('site.basePath')) {
                $url .= $basePath;
            }

            return $url."/assets/{$asset}";
        }
    ),
];
