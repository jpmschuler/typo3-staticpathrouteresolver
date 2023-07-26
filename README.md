[![TYPO3 extension staticpathrouteresolver](https://shields.io/endpoint?label=EXT&url=https://typo3-badges.dev/badge/staticpathrouteresolver/extension/shields)](https://extensions.typo3.org/extension/staticpathrouteresolver)
[![Latest TER version](https://shields.io/endpoint?label=TER&url=https://typo3-badges.dev/badge/staticpathrouteresolver/version/shields)](https://extensions.typo3.org/extension/staticpathrouteresolver)
[![Latest Packagist version](https://shields.io/packagist/v/jpmschuler/staticpathrouteresolver?label=Packagist&logo=packagist&logoColor=white)](https://packagist.org/packages/jpmschuler/staticpathrouteresolver)
![Total downloads](https://typo3-badges.dev/badge/staticpathrouteresolver/downloads/shields.svg)

![Supported TYPO3 versions](https://shields.io/endpoint?label=typo3&url=https://typo3-badges.dev/badge/staticpathrouteresolver/typo3/shields)
![Supported PHP versions](https://shields.io/packagist/php-v/jpmschuler/staticpathrouteresolver?logo=php)
[![Current CI health](https://github.com/jpmschuler/typo3-staticpathrouteresolver/actions/workflows/ci.yml/badge.svg)](https://github.com/jpmschuler/typo3-staticpathrouteresolver/actions/workflows/ci.yml)

# EXT:staticpathrouteresolver
Site config static routes which support EXT: path prefix to e.g. allow per-site favicon with cms-composer-installers >=4

# Installation
Either install `EXT:staticpathrouteresolver` via TER (Extension Manager) or via composer `jpmschuler/staticpathrouteresolver`

# How to use

Inside your site config, use
```
routes:
  -
    route: favicon.ico
    path: 'EXT:mysitepackage/Resources/Public/Icons/favicon.ico'
```
The core handler will ignore all routes without a specified type, we use that to not let core throw exceptions or interact on that config.
