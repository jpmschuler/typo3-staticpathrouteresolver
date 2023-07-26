<?php
return [
    'frontend' => [
        'jpmschuler/staticpathrouteresolver' => [
            'target' => \Jpmschuler\StaticPathRouteResolver\Middleware\StaticPathRouteResolver::class,
            'after' => [
                'typo3/cms-frontend/base-redirect-resolver'
            ],
            'before' => [
                'typo3/cms-frontend/static-route-resolver'
            ],
        ],
    ],
];
