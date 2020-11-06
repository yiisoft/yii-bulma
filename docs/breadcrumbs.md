## Breadcrumbs widget

[The Bulma breadcrumb](https://bulma.io/documentation/components/breadcrumb/) is a simple navigation component.

<p align="center">
    <img src="images/breadcrumbs.png">
</p>

### Usage

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Breadcrumbs;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

/* Register assets in view */

$assetManager->register([
    BulmaAsset::class
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>

// The Font-Awesome Asset must be added, in this case we are going to use an external library.
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

<?= Breadcrumbs::widget()
    ->homeItem([
        'label' => 'Index',
        'url' => '/index',
        'icon' => 'fas fa-home',
        'iconOptions' => ['class' => 'icon']
    ])
    ->items([
        [
            'label' => 'About',
            'url' => '/about',
            'icon' => 'fas fa-thumbs-up',
            'iconOptions' => ['class' => 'icon']
        ]
    ])
    ->options(['class' => 'is-centered'])
    ->render() ?>
```

The code above generates the following HTML:

```html
<nav id="w1-breadcrumbs" class="breadcrumb is-centered" aria-label="breadcrumbs">
    <ul>
        <li><span class="icon"><i class="fas fa-home"></i></span><a href="/index">Index</a></li>
        <li><span class="icon"><i class="fas fa-thumbs-up"></i></span><a href="/about">About</a></li>
    </ul>
</nav>
```

Method                             | Description                                                    | Default
-----------------------------------|----------------------------------------------------------------|---------
`id(string $value)`                | Widget ID.                                                     | `''`
`encodeLabels(bool $value)`        | Whether to HTML-encode the link labels.                        | `true`
`homeLink(array $value)`           | First hyperlink in the breadcrumbs (called home link).         | `''`
`itemTemplate(string $value)`      | Template used to render each inactive item in the breadcrumbs. | `<li>{icon}{link}</li>\n`
`activeItemTemplate(string $value)`| Template used to render each active item in the breadcrumbs.   | `<li class=\"is-active\"><a aria-current=\"page\">{icon}{label}</li>\n`
`itemsOptions(array $value)`       | HTML attributes for the items widget.                          | `[]`
`links(array $value)`              | List of links to appear in the breadcrumbs.                    | `[]`
`options(array $value)`            | HTML attributes for the widget container nav tag.              | `[]`
