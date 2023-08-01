<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 StaticPathRouteResolver',
    'description' => 'Site config static routes which support EXT: path prefix to e.g. allow per-site favicon with cms-composer-installers >=4',
    'category' => 'plugin',
    'version' => '1.2.0',
    'state' => 'stable',
    'author' => 'Schuler, J. Peter M.',
    'author_email' => 'j.peter.m.schuler@uni-due.de',
    'author_company' => '',
    'constraints' => [
        'depends' => [
            'php' => '7.4.0-8.2.99',
            'typo3' => '11.5.0-12.4.99'
        ]
    ],
    'autoload' => [
    'psr-4' => [
        'Jpmschuler\\StaticPathRouteResolver\\' => 'Classes/',
    ],
],
];
