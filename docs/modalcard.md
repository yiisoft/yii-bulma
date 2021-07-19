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

$widget = ModalCard::widget()
    ->title('Modal title')
    ->footer(
        Html::button('Cancel', ['class' => 'button'])
    )
    ->begin();
echo "Say hello...";
echo ModalCard::end();
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
`id(string $value)` | Widget ID. | `''`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`options(array $value)` | HTML attributes for the widget container tag. | [`class` => `modal`]
`contentOptions(array $value)` | HTML attributes for the widget content tag. | [`class` => `modal-card`]
`headerOptions(array $value)` | HTML attributes for the widget header tag. | [`class` => `modal-card-head`]
`title(string $value)` | The title content in the modal window. | `''`
`titleOptions(array $value)` | HTML attributes for the widget title tag. | [`class` => `modal-card-title`]
`bodyOptions(array $value)` | HTML attributes for the widget body tag.| [`class` => `modal-card-body`]
`footer(string $value)` | The footer content in the modal window. | `''`
`footerOptions(array $value)` | HTML attributes for the widget footer tag. | [`class` => `modal-card-foot`]
`closeButtonOptions(array $value)` | HTML attributes for the widget close button tag. | [`class` => `delete`, `aria-label` => `close`]
`closeButtonSize(string $value)` | Size close button. | `is-small`, `is-medium`, `is-large`
`toggleButtonLabel(string $value)` | Toggle button label, | `Toggle button`
`toggleButtonSize(string $value)` | Size toggle button. | `is-small`, `is-medium`, `is-large`
`toggleButtonColor(string $value)` | Toggle button color. | `is-primary`, `is-link`, `is-info`, `is-success`, `is-warning`, `is-danger`
`toggleButtonOptions(array $value)` |  HTML attributes for the widget toogle button tag. | [`class` => `button`, `aria-haspopup` => `true`]
`withoutCloseButton()` | Disable close button. | `false`
`withoutToggleButton()` | Disable toggle button. | `false`
