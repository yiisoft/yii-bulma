# Modal card widget

A classic [modal](https://bulma.io/documentation/components/modal/) overlay, in which you can include any content you want

The modal structure:
- `modal`: the main container
    - `modal-background`: a transparent overlay that can act as a click target to close the modal
    - `modal-card`: ...
        - `modal-card-head`: ...
            - `modal-card-title`: ...
    - `modal-card-body`: ...
    - `modal-card-foot`: ...

## Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\ModalCard;
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

$widget = ModalCard::begin()
    ->title('Modal title')
    ->footer(
        Html::button('Cancel', ['class' => 'button'])
    );

echo $widget->start();
echo "Say hello...";
echo $widget->end();
```

HTML produced is like the following:
```html
<div id="w1-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">Modal title</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
            Say hello...
        </section>
        <footer class="modal-card-foot">
            <button type="button" class="button">Cancel</button>
        </footer>
    </div>
</div>
```

## Reference

Method | Description | Default
-------|-------------|---------
options(array $value) | HTML attributes for the widget container tag. | [`class` => `modal`]
contentOptions(array $value) | | [`class` => `modal-card`]
headerOptions(array $value) | | [`class` => `modal-card-head`]
title(string $value) | | `''`
titleOptions(array $value) | | [`class` => `modal-card-title`]
bodyOptions(bool $value) | | [`class` => `modal-card-body`]
footer(string $value) | | `''`
footerOptions(bool $value) | | [`class` => `modal-card-foot`]
closeButtonOptions(array $value) | | [`class` => `delete`, `aria-label` => `close`]
closeButtonSize(string $value) | | `''`
toggleButtonLabel(string $value) | | `Toggle button`
toggleButtonSize(string $value) | | `''`
toggleButtonColor(string $value) | | `''`
toggleButtonOptions(array $value) | | [`class` => `button`, `aria-haspopup` => `true`]
closeButtonEnabled(bool $value) | | `true`
toggleButtonEnabled(bool $value) | | `true`
