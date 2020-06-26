## Message component

Method                            | Description
----------------------------------|------------
`id(string $value)`               | Set id widget.
`body(string $value)`             | Lets you define the content in the body message.
`headerColor(string $value)`      | Set color header message ('is-dark', 'is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger') 
`headerMessage(string $value)`    | Lets you define the content in the header message.
`options(array $value)`           | The HTML attributes for the widget container tag.
`optionsBody(array $value)`       | The HTML attributes for the widget body tag.
`optionsCloseButton(array $value)`| The options for rendering the close button tag.
`optionsHeader(array $value)`     | The HTML attributes for the widget header tag.
`size(string $value)`             | Set size message widget, default setting empty normal, 'is-small', 'is-medium', 'is-large'.
`withoutCloseButton(bool $value)` | Allows you to disable close button message widget.
`withoutHeader(bool $value)`      | Allows you to disable header widget.

The Bulma message is a multi-part component:

- the `message` container
- the optional `message-header` that can hold a title and a delete element
- the `message-body` for the longer body of the message

The css framework does not have any javascript, but you can use the asset `BulmaJsAsset::class`, which has the necessary javascript to close the notification with the close button, or use your own javascript.

Html structure:

```html
<div id="w1-message" class="message is-success">
    <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
    </div>
</div>
```

Example usage:

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Message;

<?= Message::widget()
    ->headerColor('is-success')
    ->headerMessage('Very important')
    ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
    ->size('is-large')
    ->options(['class' => 'has-text-justified']) ?>
```

<p align="center">
    <img src="images/message.png">
</p>
