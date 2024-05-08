# Progress Bar widget

[The Bulma progress bar](https://bulma.io/documentation/elements/progress/) is a simple CSS class that styles the native
`<progress>` [HTML element](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/progress).

Loading widget looks like the following:

<p align="center">
    <img src="../../images/progressbar.png">
</p>

In progress widget looks like this:

<p align="center">
    <img src="../../images/progressbar-indeterminate.gif">
</p>

## Usage

```php
<?php
use Yiisoft\Yii\Bulma\ProgressBar;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

/** Register assets in view */

$assetManager->register(BulmaAsset::class);

$this->setCssFiles($assetManager->getCssFiles());

echo ProgressBar::widget()
    ->size('is-medium')
    ->color('is-info')
    ->maxValue(100)
    ->value(75);
```

The code above generates the following HTML:

```html
<progress id="w1-progressbar" class="progress is-medium is-info" value="75" max="100">75%</progress>
```

## Setters

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\ProgressBar` class with the specified value.

Method | Description | Default
-------|-------------|---------
`attributes(array $value)` | The HTML attributes. | `[]`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`color(string $value)` | Bar color. Options available are: (`ProgressBar::COLOR_PRIMARY`, `ProgressBar::COLOR_LINK`, `ProgressBar::COLOR_INFO`, `ProgressBar::COLOR_SUCCESS`, `ProgressBar::COLOR_WARNING`, `ProgressBar::COLOR_DANGER`, `ProgressBar::COLOR_DARK`). | Default is no color.
`id(string $value)` | Widget ID. | `''`
`maxValue(int $value)` | Maximum progress value. `0` means no maximum. | `100`
`size(string $value)` | Bar size. Options available are: (`ProgressBar::SIZE_SMALL`, `ProgressBar::SIZE_MEDIUM`, `ProgressBar::SIZE_LARGE`). | Default setting is normal.
`value(float $value)` | The progress value. Set to `0` to display a loading animation. | `0`
