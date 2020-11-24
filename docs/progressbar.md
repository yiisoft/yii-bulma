## Progress Bar widget

[The Bulma progress bar](https://bulma.io/documentation/elements/progress/) is a simple CSS class that styles the native `<progress>` [HTML element](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/progress).

### In progress

<p align="center">
    <img src="images/progressbar.png">
</p>

### Indeterminate

<p align="center">
    <img src="images/progressbar-indeterminate.gif">
</p>

### Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\ProgressBar;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

/** Register assets in view */

$assetManager->register([
    BulmaAsset::class
]);

$this->setCssFiles($assetManager->getCssFiles());

echo ProgressBar::widget()
    ->size('is-medium')
    ->color('is-info')
    ->progressMax(100)
    ->progressValue(75);
```

The code above generates the following HTML:

```html
<progress id="w1-progressbar" class="progress is-medium is-info" value="75" max="100">75%</progress>
```

## Reference

Method                         | Description                                                                                                       | Default
-------------------------------|-------------------------------------------------------------------------------------------------------------------|-----
`progressValue(float\|null $value)` | The value of the progress. Set null if need display an indeterminate.                                        | `null`
`progressMax(int\|null $value)` | Maximum progress value. Set null if need remove max attribute.                                                   | `100`
`options(array $value)`        | HTML attributes for the widget container tag.                                                                     | [`class` => `progress`]
`size(string $value)`          | Progress bar widget size. Options available [are here](https://bulma.io/documentation/elements/progress/#colors). | `''`
`color(string $value)`         | Progress bar widget color. Options available [are here](https://bulma.io/documentation/elements/progress/#sizes). | `''`
