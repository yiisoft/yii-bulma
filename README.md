<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://github.com/yiisoft.png" height="100px">
    </a>
    <a href="https://bulma.io/" target="_blank" rel="external">
        <img src="docs/images/bulma-logo.png" height="80px">
    </a>
    <h1 align="center">Yii Framework Bulma Integration</h1>
    <br>
</p>

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii-bulma/v/stable.png)](https://packagist.org/packages/yiisoft/yii-bulma)
[![Build status](https://github.com/yiisoft/yii-bulma/workflows/build/badge.svg)](https://github.com/yiisoft/yii-bulma/actions?query=workflow%3Abuild)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/yii-bulma/?branch=master)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fyiisoft%2Fyii-bulma%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/yiisoft/yii-bulma/master)
[![static analysis](https://github.com/yiisoft/yii-bulma/workflows/static%20analysis/badge.svg)](https://github.com/yiisoft/yii-bulma/actions?query=workflow%3A%22static+analysis%22)

This Yii Framework package encapsulates Bulma components and plugins in terms of Yii widgets, and thus makes using Bulma components/plugins in Yii applications convenient.

## Installation

```php
composer require yiisoft/yii-bulma
```
## Using assets

Bulma is a CSS framework that provides all the CSS and SASS files to customize your application, the widgets by default do not register any Asset so you must register them in your application to be used, since you can simply use the Default CSS file layout, or build your own custom CCS.

Three Assets are provided:

- [BulmaAsset:](https://bulma.io/) CSS, SASS file bulma css framework without JS code.
- [BulmaHelperAsset:](https://github.com/jmaczan/bulma-helpers) CSS, SASS, MIXINS it is an auxiliary library provide file helpers for Bulma CSS framework.
- [BulmaJsAsset:](https://github.com/jgthms/bulma) Vizuaalog/BulmaJs it is an auxiliary library that has all the JS used by the Bulma CSS framework, you can decide to use this library, or alternatively write your own JS code.

To use widgets only, register `BulmaAsset::class`, which we can do in several ways explained below.

### Register asset in view layout or individual view

By registering the Asset in the `resources/layout/main.php` available for all views or `resources/views/site/contact.php` for an individual view.

main.php or contact.php

```php
use  Yiisoft\Yii\Bulma\Asset\BulmaAsset;

/**
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var Yiisoft\View\WebView $this
 */

$assetManager->register([
    BulmaAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
```

### Register in params application

You can register it in the application parameters for which the Asset will be available for all views.

```php
use  Yiisoft\Yii\Bulma\Asset\BulmaAsset;

'yiisoft/asset' => [
    'assetManager' => [
        'register' => [
            BulmaAsset::class
        ],
    ],
],
```

Then in `main.php`:

```php
/* @var Yiisoft\View\WebView $this */

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
```

## Widgets usage

We will quickly and easily describe how to use widgets, and be able to use all the power of the Bulma CSS framework with php.

- [NavBar](docs/navbar.md)
- [Message](docs/message.md)

## Unit testing

The package is tested with [PHPUnit](https://phpunit.de/). To run tests:

```php
./vendor/bin/phpunit
```

## Mutation testing

The package tests are checked with [Infection](https://infection.github.io/) mutation framework. To run it:

```php
./vendor/bin/infection
```

## Static analysis

The code is statically analyzed with [Phan](https://github.com/phan/phan/wiki). To run static analysis:

```php
./vendor/bin/phan
```
