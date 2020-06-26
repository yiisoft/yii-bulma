## Navbar component

Method                       | Description | Default |
-----------------------------|-------------|---------|
`brandLabel(string $value)`  | The text of the brand label| ''
`brandImage(string $value)`  | The image of the brand. | ''
`brandUrl(string $value)`    | The URL for the brand's hyperlink tag and will be used for the "href" attribute of the brand link. | `/`
`options`                    | Options HTML attributes for the tag nav. | [`class` => `navbar`]
`optionsBrand(array $value)` | Options HTML attributes of the tag div brand. | [`class` => `navbar-brand`]
`optionsBrandLabel`          | Options HTML attributes of the tag div brand label. | [`class` => `navbar-item`]
`optionsBrandImage`          | Options HTML attributes of the tag div brand link. | [`class` => `navbar-item`]
`optionsItems(array $value)` | Options HTML attributes of the tag div items nav. | [`class` => `navbar-start`] or [`class` => `navbar-end`]
`optionsMenu(array $value)`  | Options HTML attributes of the tag div nav menu. | [`class` => `navbar-menu`]
`optionsToggle(array $value)`| The HTML attributes of the navbar toggler button. | [`aria-expanded` => `false`, `aria-label` => `menu`, `class` => `navbar-burger`, `role` => `button`]


The navbar component is a responsive and versatile horizontal navigation bar with the following structure:

- `navbar` the main container
- `navbar-brand` the left side, always visible, which usually contains the logo and optionally some links or icons
- `navbar-burger` the hamburger icon, which toggles the navbar menu on touch devices
- `navbar-menu` the right side, hidden on touch devices, visible on desktop
- `navbar-start` the left part of the menu, which appears next to the navbar brand on desktop
- `navbar-end` the right part of the menu, which appears at the end of the navbar
- `navbar-item` each single item of the navbar, which can either be an a or a div

Html structure:

```html
<nav id="w1-navbar" class="navbar is-black" data-sticky="" data-sticky-shadow="">
    <div class="navbar-brand">
        <span class="navbar-item">
            <img src="yii-logo.jpg" alt="">
        </span>
        <a class="navbar-item" href="/">My Proyect</a>
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
            <span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span>
        </a>
    </div>
    <div id="w1-navbar-Menu" class="navbar-menu">
        <div class="navbar-start"></div>
    </div>
</nav>
```

Example usage:

```php
<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\NavBar;
?>

<?= NavBar::begin()
    ->brandLabel('My Proyect')
    ->brandImage('yii-logo.jpg')
    ->brandUrl('/')
    ->options(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
    ->start(); ?>

    // nav menu widget.

<?= NavBar::end() 
```

<p align="center">
    <img src="images/navbar.png">
</p>
