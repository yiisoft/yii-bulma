# Modal widget

A base [modal](https://bulma.io/documentation/components/modal/) overlay, in which you can include any content you want

The modal structure:
- `modal`: the main container
    - `modal-background`: a transparent overlay that can act as a click target to close the modal
    - `modal-content`: a horizontally and vertically centered container, in which you can include any content
    - `modal-close`: a simple cross located in the top right corner

## Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Modal;
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

echo Modal::widget()
    ->closeButtonSize(Modal::SIZE_LARGE)
    ->begin();
echo Html::tag('div', 'Say hello...', ['class' => 'box']);
echo Modal::end();
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
    <button type="button" class="modal-close is-large" aria-label="close"></button>
</div>
```

## Reference

Method | Description | Default
-------|-------------|---------
`id(string $value)` | Widget ID. | `''`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`options(array $value)` | HTML attributes for the widget container tag. | [`class` => `modal`]
`contentOptions(array $value)`| HTML attributes for the widget content tag. | `[]`
`closeButtonOptions(array $value)` | HTML attributes for the widget button tag. | [`class` => `modal-close`, `aria-label` => `close`]
`closeButtonSize(string $value)` | Size close button. | `is-small`, `is-medium`, `is-large`
`toggleButtonLabel(string $value)` | Toggle button label, | `Toggle button`
`toggleButtonSize(string $value)` | Size toggle button. | `is-small`, `is-medium`, `is-large`
`toggleButtonColor(string $value)` | Toggle button color. | `is-primary`, `is-link`, `is-info`, `is-success`, `is-warning`, `is-danger`
`toggleButtonOptions(array $value)` |  HTML attributes for the widget toogle button tag. | [`class` => `button`, `aria-haspopup` => `true`]
`withoutCloseButton()` | Disable close button. | `false`
`withoutToggleButton()` | Disable toggle button. | `false`
