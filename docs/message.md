# Component Message

## Methods

Method                          | Description
--------------------------------|------------
id(string $value)               | Set id widget.
body(string $value)             | Lets you define the content in the body message.
headerColor(string $value)      | Set color header message ('is-dark', 'is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger') 
headerMessage(string $value)    | Lets you define the content in the header message.
options(array $value)           | The HTML attributes for the widget container tag.
optionsBody(array $value)       | The HTML attributes for the widget body tag.
optionsCloseButton(array $value)| The options for rendering the close button tag.
optionsHeader(array $value)     | The HTML attributes for the widget header tag.
size(string $value)             | Set size message widget, default setting empty normal, 'is-small', 'is-medium', 'is-large'.
withoutCloseButton(bool $value) | Allows you to disable close button message widget.
withoutHeader(bool $value)      | Allows you to disable header widget.

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

## Example widget message

<p align="center">
    <img src="images/message.png">
</p>
