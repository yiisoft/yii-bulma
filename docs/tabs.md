# Tabs widget

Responsive horizontal [navigation tabs](https://bulma.io/documentation/components/tabs/), with different styles.

## Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Tabs;
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

echo Tabs::widget()
    ->alignment(Tabs::ALIGNMENT_CENTERED)
    ->items([
        ['label' => 'Pictures', 'icon' => 'fas fa-image', 'active' => true],
        ['label' => 'Music', 'icon' => 'fas fa-music'],
        ['label' => 'Videos', 'icon' => 'fas fa-film'],
        ['label' => 'Documents', 'icon' => 'far fa-file-alt'],
    ]);
```

HTML produced is like the following:

```html
<div class="tabs is-centered">
  <ul>
    <li class="is-active">
      <a>
        <span class="icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span>
        <span>Pictures</span>
      </a>
    </li>
    <li>
      <a>
        <span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span>
        <span>Music</span>
      </a>
    </li>
    <li>
      <a>
        <span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span>
        <span>Videos</span>
      </a>
    </li>
    <li>
      <a>
        <span class="icon is-small"><i class="far fa-file-alt" aria-hidden="true"></i></span>
        <span>Documents</span>
      </a>
    </li>
  </ul>
</div>
```

## Reference

Method | Description | Default
-------|-------------|---------
options(array $value) | HTML attributes for the widget container tag. | [`class` => `tabs`]
items(array $value) | | `[]`
currentPath(?string $value) | | `null`
activateItems(bool $value) | | `true`
encodeLabels(bool $value) | | `true`
size(string $value) | | `''`
alignment(string $value) | | `''`
style(string $value) | | `''`
