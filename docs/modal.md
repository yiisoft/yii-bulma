# Modal widget

A base [modal](https://bulma.io/documentation/components/modal/) overlay, in which you can include any content you want

The modal structure:
- `modal`: the main container
    - `modal-background`: a transparent overlay that can act as a click target to close the modal
    - `modal-content`: a horizontally and vertically centered container, in which you can include any content
    - `modal-close`: a simple cross located in the top right corner

<p align="center">
    </br>
    <img src="images/modal.png">
</p>    

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

$assetManager->register(BulmaAsset::class);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());

// Note: Bulma does not include any JavaScript interaction. You will have to implement the class toggle yourself.
// Example of a toggle:
$modalJS = <<<JS
    var rootEl = document.documentElement;
    var $modals = getAll('.modal');
    var $modalButtons = getAll('.modal-button');
    var $modalCloses = getAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button');

    if ($modalButtons.length > 0) {
        $modalButtons.forEach(function ($el) {
        $el.addEventListener('click', function () {
            var target = $el.dataset.target;
                openModal(target);
            });
        });
    }

    if ($modalCloses.length > 0) {
        $modalCloses.forEach(function ($el) {
            $el.addEventListener('click', function () {
                closeModals();
            });
        });
    }

    function openModal(target) {
        var $target = document.getElementById('modal');
        rootEl.classList.add('is-clipped');
        $target.classList.add('is-active');
    }

    function closeModals() {
        rootEl.classList.remove('is-clipped');
        $modals.forEach(function ($el) {
            $el.classList.remove('is-active');
        });
    }

    function getAll(selector) {
        var parent = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

        return Array.prototype.slice.call(parent.querySelectorAll(selector), 0);
    }

    document.addEventListener('keydown', function (event) {
        var e = event || window.event;

        if (e.keyCode === 27) {
            closeModals();
            closeDropdowns();
        }
    });
JS;

$this->registerJs($modalJS);
?>

<?= Modal::widget()
        ->id('modal')
        ->begin() .
    Div::tag()
        ->class('box')
        ->content('Say hello...')
        ->render() . PHP_EOL .
    Modal::end() ?>
```

The code above generates the following HTML:

```html
<button class="button modal-button" data-target="#modal" aria-haspopup="true">Toggle button</button>
<div id="modal" class="modal">
    <div class="modal-background"></div>
    <button class="modal-close" aria-label="close"></button>
    <div class="modal-content">
        <div class="box">Say hello...</div>
    </div>
</div>
```

## Setters

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\Modal` class with the specified value.

Method | Description | Default
-------|-------------|---------
`attributes(array $value)` | The HTML attributes. | `[]`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`backgroundClass(string $value)` | Class for the modal background. | `modal-background`
`buttonClass(string $value)` | Class for the modal button. | `button modal-button`
`closeButtonAttributes(array $value)` | HTML attributes for the close button tag. | [`class` => `modal-close`, `aria-label` => `close`]
`closeButtonSize(string $value)` | Close button size. Options available are: (`Modal::SIZE_SMALL`, `Modal::SIZE_MEDIUM`, `Modal::SIZE_LARGE`). | Default size is normal.
`contentAttributes(array $value)`| HTML attributes for the content tag. | `[]`
`contentClass(string $value)` | Class for the modal content. | `modal-content`
`id(string $value)` | Widget ID. | `''`
`modalClass(string $value)` | Class for the modal. | `modal`
`toggleButtonAttributes(array $value)` |  HTML attributes for the toogle button tag. | [`class` => `button`, `aria-haspopup` => `true`]
`toggleButtonColor(string $value)` | Toggle button color. Options available are: (`Modal::COLOR_PRIMARY`, `Modal::COLOR_LINK`, `Modal::COLOR_INFO`, `Modal::COLOR_SUCCESS`, `Modal::COLOR_WARNING`, `Modal::COLOR_DANGER`, `Modal::COLOR_DARK`). | Default setting empty whitout color.
`toggleButtonLabel(string $value)` | Toggle button label, | `Toggle button`
`toggleButtonSize(string $value)` | Size toggle button. Options available are: (`Modal::SIZE_SMALL`, `Modal::SIZE_MEDIUM`, `Modal::SIZE_LARGE`). | Default setting empty normal.
`withoutCloseButton(bool $value)` | Whether the close button is disabled. | `false`
`withoutToggleButton(bool $value)` | Whether the toggle button is disabled. | `false`
