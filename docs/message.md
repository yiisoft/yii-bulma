# Message widget

[The message component](https://bulma.io/documentation/components/message/) displays a message like the following:

<p align="center">
    <img src="images/message.png">
</p>

HTML generated consists of:

- A `message` container.
- An optional `message-header` that can hold a title, and a "delete" element.
- A `message-body` for the longer body of the message.

In order for the message to be close-able you can use the asset `BulmaJsAsset::class`, which registers
necessary JavaScript. Alternatively, you can use your own JavaScript code.

## Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Message;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaJsAsset;

/* Register assets in view */

$assetManager->registerMany([
    BulmaAsset::class,
    BulmaJsAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>

<?= Message::widget()
    ->attributes(['class' => 'has-text-justified'])
    ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
    ->headerColor('is-success')
    ->headerMessage('Very important')
    ->size('is-large') ?>
```

The code above generates the following HTML:

```html
<div id="w1-message" class="message is-success has-text-justified">
    <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete is-large"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    </div>
</div>
```

## Setters

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\Breadcrumbs` class with the specified value.

Method | Description | Default
-------|-------------|---------
`attributes(array $value)` | The HTML attributes | `[]`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`body(string $value)` | Message body. | `''`
`bodyAttributes(array $value)` | HTML attributes for the body tag. | `[]`
`closeButtonAttributes(array $value)`| HTML attributes for rendering the close button tag. | `[]`
`headerColor(string $value)` | Message color. (`Modal::COLOR_DARK`, `Modal::COLOR_PRIMARY`, `Modal::COLOR_LINK`, `Modal::COLOR_INFO`, `Modal::COLOR_SUCCESS`, `Modal::COLOR_WARNING`, `Modal::COLOR_DANGER`). | `Modal::COLOR_DARK`
`headerMessage(string $value)` | Message header. | `''`
`headerAttributes(array $value)` | HTML attributes for the header tag. | `[]`
`id(string $value)` | Widget ID. | `''`
`size(string $value)` | Message widget size. Default is normal. Options available are: (`Modal::SIZE_SMALL`, `Modal::SIZE_MEDIUM`, `Modal::SIZE_LARGE`.  | `normal`
`withoutCloseButton(bool $value)` | Whether the close button is disabled. | `false`
`withoutHeader(bool $value)` | Whether the header is disabled. | `false`
