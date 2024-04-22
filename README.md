<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://yiisoft.github.io/docs/images/yii_logo.svg" height="100px">
    </a>
    <a href="https://bulma.io/" target="_blank" rel="external">
        <img src="docs/images/bulma-logo.png" height="100px">
    </a>
    <h1 align="center">Yii Framework Bulma Integration</h1>
    <br>
</p>

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii-bulma/v/stable.png)](https://packagist.org/packages/yiisoft/yii-bulma)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii-bulma/downloads.png)](https://packagist.org/packages/yiisoft/yii-bulma)
[![Build status](https://github.com/yiisoft/yii-bulma/workflows/build/badge.svg)](https://github.com/yiisoft/yii-bulma/actions?query=workflow%3Abuild)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/?branch=master)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fyiisoft%2Fyii-bulma%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/yiisoft/yii-bulma/master)
[![static analysis](https://github.com/yiisoft/yii-bulma/workflows/static%20analysis/badge.svg)](https://github.com/yiisoft/yii-bulma/actions?query=workflow%3A%22static+analysis%22)
[![type-coverage](https://shepherd.dev/github/yiisoft/yii-bulma/coverage.svg)](https://shepherd.dev/github/yiisoft/yii-bulma)

This [Yii Framework](https://www.yiiframework.com/) package encapsulates [Bulma](https://bulma.io) components
and plugins in terms of Yii widgets, and thus makes using Bulma components/plugins in Yii applications convenient.

## Requirements

- PHP 8.0 or higher.

## Installation

```shell
composer require yiisoft/yii-bulma --prefer-dist
```

## Install assets

There are several ways to install the assets, they are:

1. Using the [AssetPackagist](https://asset-packagist.org/) package manager.

Add to composer.json file the following:

```json
{
    "require": {
        "npm-asset/bulma": "^0.9.3",
        "npm-asset/bulma-helpers": "^0.4.2",
        "npm-asset/vizuaalog--bulmajs": "^0.12.1",
        "oomphinc/composer-installers-extender": "^2.0.0",
    },
    "extra": {
        "installer-types": [
            "npm-asset"
        ],
        "installer-paths": {
            "./node_modules/{$name}": [
                "type:npm-asset"
            ]
        }
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://asset-packagist.org"
        }
    ]
}
```

Once the changes are made, you can install the assets using the following command:

```php
composer update --prefer-dist
```

2. Using the [npm-asset](https://www.npmjs.com/) package manager.

Run the following command at the root directory of your application.

```shell
npm i bulma
npm i @vizuaalog/bulmajs
npm i bulma-helpers
```

## Using assets

Bulma is a CSS framework that provides all the CSS and SASS files to customize your application, the widgets by default
do not register any Asset so you must register them in your application to be used, since you can simply use the
default CSS file layout, or build your own custom CCS.

Three Assets are provided:

- [BulmaAsset](https://bulma.io/): CSS, SASS file bulma css framework without JS code.
- [BulmaHelperAsset](https://github.com/jmaczan/bulma-helpers): CSS, SASS, MIXINS it is an auxiliary library provide
  file helpers for Bulma CSS framework.
- [BulmaJsAsset](https://github.com/jgthms/bulma): Vizuaalog/BulmaJs it is an auxiliary library that has all the JS
  used by the Bulma CSS framework, you can decide to use this library, or alternatively write your own JS code.

To use widgets only, register `BulmaAsset::class`, which we can do in several ways explained below.

### Register asset in view layout or individual view

By registering the Asset in the `resources/layout/main.php` it will be available for all views.
If you need it registered for individual view (such as `resources/views/site/contact.php`) only,
register it in that view.

```php
use  Yiisoft\Yii\Bulma\Asset\BulmaAsset;

/**
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var Yiisoft\View\WebView $this
 */

$assetManager->register(BulmaAsset::class);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
```

### Register asset in application params

You can register asset in the assets parameters, (by default, this is `config/packages/yiisoft/assets/params.php`).
Asset will be available for all views of this application.

```php
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

'yiisoft/asset' => [
    'assetManager' => [
        'register' => [
            BulmaAsset::class,
        ],
    ],
],
```

Then in `resources/layout/main.php`:

```php
/* @var Yiisoft\View\WebView $this */

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
```

## Documentation

- [Guides](docs/guide/README.md)
- [Internals](docs/internals.md)

## Support

If you need help or have a question, the [Yii Forum](https://forum.yiiframework.com/c/yii-3-0/63) is a good place for that.
You may also check out other [Yii Community Resources](https://www.yiiframework.com/community).

## Support the project

[![Open Collective](https://img.shields.io/badge/Open%20Collective-sponsor-7eadf1?logo=open%20collective&logoColor=7eadf1&labelColor=555555)](https://opencollective.com/yiisoft)

## Follow updates

[![Official website](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)
[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/yiiframework)
[![Telegram](https://img.shields.io/badge/telegram-join-1DA1F2?style=flat&logo=telegram)](https://t.me/yii3en)
[![Facebook](https://img.shields.io/badge/facebook-join-1DA1F2?style=flat&logo=facebook&logoColor=ffffff)](https://www.facebook.com/groups/yiitalk)
[![Slack](https://img.shields.io/badge/slack-join-1DA1F2?style=flat&logo=slack)](https://yiiframework.com/go/slack)

## License

The Yii Framework Bulma Integration is free software. It is released under the terms of the BSD License.
Please see [`LICENSE`](./LICENSE.md) for more information.

Maintained by [Yii Software](https://www.yiiframework.com/).
