## Breadcrumbs widget

The Bulma breadcrumb is a simple navigation component that only requires a breadcrumb `container` and `ul` list. The dividers are automatically created in the content of the ::before pseudo-element of li tags.

You can inform the current page using the is-active modifier in a li tag. It will disable the navigation of inner links.

<p align="center">
    <img src="images/breadcrumbs.png">
</p>

### Usage

```php
<?php

declare(strict_types=1);

/** 
 * The Font-Awesome Asset must be added, in this case we are going to use an external library.
 * {@see https://github.com/yii-extension/fontawesome}
 */
use Yii\Extension\Fontawesome\Dev\Css\NpmAllAsset;
use Yiisoft\Yii\Bulma\Breadcrumbs;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;

/* Register assets in view */

$assetManager->register([
    BulmaAsset::class,
    NpmAllAsset::class,
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>

<?= Breadcrumbs::widget()
    ->encodeLabels(false)
    ->homeLink([
        'label' => '<span class="icon is-small"><i class="fas fa-home" aria-hidden="true"></i></span> Home',
        'url' => '/index'
    ])
    ->links([['label' => 'About', 'url' => '/about']])
    ->options(['class' => 'is-centered'])
    ->render() ?>
```

The code above generates the following HTML:

```html
<nav id="w2-breadcrumbs" class="breadcrumb is-centered" aria-label="breadcrumbs">
    <ul>
        <li><a href="/index"><span class="icon is-small"><i class="fas fa-home" aria-hidden="true"></i></span> Home</a></li>
        <li><a href="/about">About</a></li>
    </ul>
</nav>
```

Method                             | Description
-----------------------------------|------------
`id(string $value)`                | Widget ID.
`encodeLabels(bool $value)`        | Whether to HTML-encode the link labels.
`homeLink(array $value)`           | The first hyperlink in the breadcrumbs (called home link).
`itemTemplate(string $value)`      | The template used to render each inactive item in the breadcrumbs.
`itemTemplateActive(string $value)`| The template used to render each active item in the breadcrumbs.
`links(array $value)`              | List of links to appear in the breadcrumbs.
`options(array $value)`            | The HTML attributes for the widget container nav tag.
`optionsItems(array $value)`       | The HTML attributes for the items widget. 