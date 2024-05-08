# Breadcrumbs widget

### [The Bulma breadcrumb](https://bulma.io/documentation/components/breadcrumb/) is a simple navigation component

<p align="center">
    </br>
    <img src="../../images/breadcrumbs.png">
</p>

## Usage

```php
<?php
use Yiisoft\Yii\Bulma\Breadcrumbs;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

/* Register assets in view */

$assetManager->register(BulmaAsset::class);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>

// The Font-Awesome Asset must be added, in this case we are going to use an external library.
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

<?= Breadcrumbs::widget()
    ->attributes(['class' => 'is-centered'])
    ->homeItem([
        'label' => 'Index',
        'url' => '/index',
        'icon' => 'fas fa-home',
        'iconAttributes' => ['class' => 'icon']
    ])
    ->items([
        [
            'label' => 'About',
            'url' => '/about',
            'icon' => 'fas fa-thumbs-up',
            'iconAttributes' => ['class' => 'icon']
        ]
    ])
    ->render() ?>
```

The code above generates the following HTML:

```html
<nav id="w71391357285001-breadcrumbs" class="is-centered breadcrumb" aria-label="breadcrumbs">
    <ul>
        <li><span class="icon"><i class="fas fa-home"></i></span><a href="/index">Index</a></li>
        <li><span class="icon"><i class="fas fa-thumbs-up"></i></span><a href="/about">About</a></li>
    </ul>
</nav>
```

## Setters

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\Breadcrumbs` class with the specified value.

Method | Description | Default
-------|-------------|---------
`activeItemTemplate(string $value)`| Template used to render each active item in the breadcrumbs. | `<li class=\"is-active\"><a aria-current=\"page\">{link}</a></li>\n`
`ariaLabel` | Defines a string value that labels the current element. | `breadcrumbs`
`attributes(array $value)` | HTML attributes for the widget container nav tag. | `[]`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`encode()` | Enable/Disable encoding for labels. | `false`
`homeItem(?array $value)` | The first item in the breadcrumbs (called home link). | `['label' => 'Home', 'url' => '/']`
`id(string $value)` | Widget ID. | `''`
`items(array $value)` | List of items to appear in the breadcrumbs. | `[]`
`itemsAttributes(array $value)` | HTML attributes for the items widget. | `[]`
`itemTemplate(string $value)` | Template used to render each inactive item in the breadcrumbs. | `<li>{icon}{link}</li>\n`

### Items structure is an array of the following structure

```php
[
    [
        'label' => 'Home',
        'url' => '/',
        'template' => '<li><a href="{url}">{icon}{label}</a></li>',
        'encode' => true,
        'icon' => 'fas fa-home',
        'iconAttributes' => ['class' => 'icon'],
    ],
]
```
