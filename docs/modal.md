# Modal widget

A classic [modal](https://bulma.io/documentation/components/modal/) overlay, in which you can include any content you want

The modal structure:
- `modal`: the main container
    - `modal-background`: a transparent overlay that can act as a click target to close the modal
    - `modal-content`: a horizontally and vertically centered container, in which you can include any content
    - `modal-close`: a simple cross located in the top right corner

## Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Modal;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaJsAsset;

/** Register assets in view */

$assetManager->register([
    BulmaAsset::class,
    BulmaJsAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>

<?= Modal::widget()->start() ?>

<div class="box">
    Say hello...
</div>

<?= Modal::end() ?>
```

HTML produced is like the following:
```html
<button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            Say hello...
        </div>
    </div>
    <button type="button" class="modal-close" aria-label="close"></button>
</div>
```

## Reference

Method | Description | Default
-------|-------------|---------
options(array $value) | HTML attributes for the widget container tag. | [`class` => `modal`, `id` => `w{$counter}-modal`]
contentOptions(array $value) | | `[]`
closeButtonOptions(array $value) | | [`class` => `modal-close`]
closeButtonSize(string $value) | | `''`
toggleButtonLabel(string $value) | | `Toggle button`
toggleButtonSize(string $value) | | `''`
toggleButtonColor(string $value) | | `''`
toggleButtonOptions(array $value) | | [`class` => `button`, `data-target` => `#w{$counter}-modal`, `aria-haspopup` => `true`]
closeButtonEnabled(bool $value) | | `true`
toggleButtonEnabled(bool $value) | | `true`
