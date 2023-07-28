[![TYPO3 extension staticpathrouteresolver](https://shields.io/endpoint?label=EXT&url=https://typo3-badges.dev/badge/staticpathrouteresolver/extension/shields)](https://extensions.typo3.org/extension/staticpathrouteresolver)
[![Latest TER version](https://shields.io/endpoint?label=TER&url=https://typo3-badges.dev/badge/staticpathrouteresolver/version/shields)](https://extensions.typo3.org/extension/staticpathrouteresolver)
[![Latest Packagist version](https://shields.io/packagist/v/jpmschuler/staticpathrouteresolver?label=Packagist&logo=packagist&logoColor=white)](https://packagist.org/packages/jpmschuler/staticpathrouteresolver)
![Total downloads](https://typo3-badges.dev/badge/staticpathrouteresolver/downloads/shields.svg)

![Supported TYPO3 versions](https://shields.io/endpoint?label=typo3&url=https://typo3-badges.dev/badge/staticpathrouteresolver/typo3/shields)
![Supported PHP versions](https://shields.io/packagist/php-v/jpmschuler/staticpathrouteresolver?logo=php)
[![Current CI health](https://github.com/jpmschuler/typo3-staticpathrouteresolver/actions/workflows/ci.yml/badge.svg)](https://github.com/jpmschuler/typo3-staticpathrouteresolver/actions/workflows/ci.yml)

# EXT:staticpathrouteresolver
Site config static routes which support EXT: path prefix to e.g. allow per-site redirect of `/favicon.ico` with
* TYPO3 11 LTS using `typo3/cms-composer-installers` `v4.0.0RC1` or with

# Installation
Either install
* via composer using `composer req jpmschuler/staticpathrouteresolver`
* via TER (Extension Manager) [`EXT:staticpathrouteresolver`](https://extensions.typo3.org/extension/staticpathrouteresolver)

# How to use

Inside your site config, use
```
routes:
  -
    route: favicon.ico
    path: 'EXT:mysitepackage/Resources/Public/Icons/favicon.ico'
```
The core handler will ignore all routes without a specified type, we use that to not let core throw exceptions or interact on that config.


|                 | URL                                                                |
|-----------------|--------------------------------------------------------------------|
| **Repository:** | https://github.com/jpmschuler/typo3-staticpathrouteresolver               |
| **TER:**        | https://extensions.typo3.org/extension/staticpathrouteresolver           |
| **Packagist:**  | https://packagist.org/packages/jpmschuler/staticpathrouteresolver  |
