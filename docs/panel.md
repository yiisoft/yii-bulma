# Panel widget

A composable [panel](https://bulma.io/documentation/components/panel/), for compact controls

## Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Panel;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaJsAsset;

/**
 * @var \Yiisoft\Assets\AssetManager $assetManager
 * @var \Yiisoft\View\WebView $this
 */

$assetManager->register([
    BulmaAsset::class,
    BulmaJsAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());

$template =<<<HTML
    {panelBegin}
    {panelHeading}
    {panelTabs}
    <div class="panel-block">
        <p class="control has-icons-left">
            <input class="input" type="text" placeholder="Search" />
            <span class="icon is-left">
                <i class="fas fa-search" aria-hidden="true"></i>
            </span>
        </p>
    </div>
    {panelItems}
    <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">
            Reset all filters
        </button>
    </div>
    {panelEnd}
HTML;

echo Panel::widget()
    ->template($template)
    ->heading('Repositories')
    ->color(Panel::COLOR_PRIMARY)
    ->tabs([
        ['label' => 'All', 'active' => true],
        ['label' => 'Public'],
        ['label' => 'Private'],
        ['label' => 'Sources'],
        ['label' => 'Forks'],
    ])
```

HTML produced is like the following:

```html
<article class="panel is-primary">
    <p class="panel-heading">Repositories</p>
    <p class="panel-tabs">
        <a class="is-active">All</a>
        <a>Public</a>
        <a>Private</a>
        <a>Sources</a>
        <a>Forks</a>
    </p>
    <div class="panel-block">
        <p class="control has-icons-left">
            <input class="input is-primary" type="text" placeholder="Search" />
            <span class="icon is-left">
                <i class="fas fa-search" aria-hidden="true"></i>
            </span>
        </p>
    </div>
    <a class="panel-block is-active">
        <span class="panel-icon">
            <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        bulma
    </a>
    <a class="panel-block">
        <span class="panel-icon">
            <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        marksheet
    </a>
    <a class="panel-block">
        <span class="panel-icon">
            <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        minireset.css
    </a>
    <a class="panel-block">
        <span class="panel-icon">
            <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        jgthms.github.io
    </a>
    <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">
            Reset all filters
        </button>
    </div>
</article>
```

## Reference

| Method                         | Description                                   | Default                      |
| ------------------------------ | --------------------------------------------- | ---------------------------- |
| `options(array $value)`        | HTML attributes for the widget container tag. | [`class` => `panel`]         |
| `headingOptions(array $value)` |                                               | [`class` => `panel-heading`] |
| `heading(?string $value)`      |                                               | `''`                         |
| `color(string $value)`         |                                               | `''`                         |
| `tabs(array $value)`           |                                               | `[]`                         |
| `tabsOptions(array $value)`    |                                               | `[]`                         |
| `encodeLabels(bool $value)`    |                                               | `true`                       |
