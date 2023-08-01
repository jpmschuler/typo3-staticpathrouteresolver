<?php
// add new icon to ease edit
$GLOBALS['SiteConfiguration']['site_route']['columns']['type']['config']['items'][] = [
    'LLL:EXT:staticpathrouteresolver/Resources/Private/Language/locallang.xlf:site_route.path',
    ''
];
// required forbids empty values and we need to allow empty values
unset($GLOBALS['SiteConfiguration']['site_route']['columns']['type']['config']['required']);

$GLOBALS['SiteConfiguration']['site_route']['columns']['path'] = [
    'config' => [
        'eval' => 'trim',
        'placeholder' => 'LLL:EXT:staticpathrouteresolver/Resources/Private/Language/locallang.xlf:site_route.path.placeholder',
        'required' => 1,
        'type' => 'input'
    ],
    'label' => 'LLL:EXT:staticpathrouteresolver/Resources/Private/Language/locallang.xlf:site_route.path',
    'description' => 'LLL:EXT:staticpathrouteresolver/Resources/Private/Language/locallang.xlf:site_route.path.description'
];

$GLOBALS['SiteConfiguration']['site_route']['types'][1] = [
   'showitem' => 'route, type, path'
];
