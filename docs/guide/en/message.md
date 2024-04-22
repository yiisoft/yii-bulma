# Message widget

### [The message component](https://bulma.io/documentation/components/message/) displays a message like the following

<p align="center">
    </br>
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

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\Message` class with the specified value.

Method | Description | Default
-------|-------------|---------
`attributes(array $value)` | The HTML attributes | `[]`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`body(string $value)` | Message body. | `''`
`bodyAttributes(array $value)` | HTML attributes for the body tag. | `[]`
`bodyCssClass(string $value)` | CSS class for the body container. | `''`
`closeButtonAttributes(array $value)`| HTML attributes for rendering the close button tag. | `[]`
`encode()` | Enable/Disable encoding for labels. | `false`
`headerAttributes(array $value)` | HTML attributes for the header tag. | `[]`
`headerColor(string $value)` | Message color. Options available are: (`Message::COLOR_DARK`, `Message::COLOR_PRIMARY`, `Message::COLOR_LINK`, `Message::COLOR_INFO`, `Message::COLOR_SUCCESS`, `Message::COLOR_WARNING`, `Message::COLOR_DANGER`). | `Message::COLOR_DARK`
`headerMessage(string $value)` | Message header. | `''`
`id(string $value)` | Widget ID. | `''`
`size(string $value)` | Message widget size. Default is normal. Options available are: (`Message::SIZE_SMALL`, `Message::SIZE_MEDIUM`, `Message::SIZE_LARGE`.  | `normal`
`withoutCloseButton(bool $value)` | Whether the close button is disabled. | `false`
`withoutHeader(bool $value)` | Whether the header is disabled. | `false`
