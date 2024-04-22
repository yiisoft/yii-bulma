# Navbar and nav widget

### [The navbar component](https://bulma.io/documentation/components/navbar/) is a responsive and versatile horizontal navigation bar

<p align="center">
    </br>
    <img src="images/navbar.png">
</p>

<p align="center">
    </br>
    <img src="images/navbar-responsive-1.png">
</p>

<p align="center">
    </br>
    <img src="images/navbar-responsive-2.png">
</p>

HTML generated consists of:

- `navbar` the main container.
- `navbar-brand` the left side, always visible, which usually contains the logo and optionally some links or icons.
- `navbar-burger` the hamburger icon, which toggles the navbar menu on touch devices.
- `navbar-menu` the right side, hidden on touch devices, visible on a desktop.
- `navbar-start` the left part of the menu, which appears next to the navbar brand on desktop.
- `navbar-end` the right part of the menu, which appears at the end of the navbar.
- `navbar-item` each single item of the navbar, which can either be an a or a div.

## Usage

You can use Navbar the following way:

```php
<?php
use Yiisoft\Yii\Bulma\Nav;
use Yiisoft\Yii\Bulma\NavBar;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaJsAsset;

/**
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var Yiisoft\View\WebView $this
 */

/* Register assets in view */

$assetManager->registerMany([
    BulmaAsset::class,
    BulmaJsAsset::class
]);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>

// The Font-Awesome Asset must be added, in this case we are going to use an external library.
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

<?= NavBar::widget()
    ->attributes(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
    ->brandImage('yii-logo.jpg')
    ->brandText('My Project')
    ->brandUrl('/')
    ->begin()
?>

<?= Nav::widget()
    ->enclosedByEndMenu()
    ->items([
        [
            'label' => 'Setting Account',
            'url' => '/setting/account',
            'icon' => 'fas fa-user-cog',
            'iconAttributes' => ['class' => 'icon']
        ],
        [
            'label' => 'Profile',
            'url' => '/profile',
            'icon' => 'fas fa-users',
            'iconAttributes' => ['class' => 'icon']
        ],
        [
            'label' => 'Admin' . Html::img(
                '../../docs/images/icon-avatar.png',
                ['class' => 'img-rounded', 'aria-expanded' => 'false']
            ),
            'items' => [
                ['label' => 'Logout', 'url' => '/auth/logout'],
            ],
            'encode' => false
        ]
    ])
    ->render()
?>

<?= NavBar::end() ?>
```

The code above generates the following HTML:

```html
<nav id="w1-navbar" class="is-black navbar" data-sticky data-sticky-shadow aria-label="main navigation" role="navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/"><img src="yii-logo.jpg">My Project</a>
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-end">
            <a class="navbar-item" href="/setting/account">Setting Account</a>
            <a class="navbar-item" href="/profile">Profile</a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="#">Admin<img src="../../docs/images/icon-avatar.png" alt></a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/auth/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
```

## Setters

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\NavBar` class with the specified value.

Method | Description | Default
-------|-------------|---------
`ariaLabel(string $value)` | The ARIA label of the navbar. | `'main navigation'`
`attributes(array $values)` | HTML attributes for the widget container nav. | `[]`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`brandAttributes(array $values)` | HTML attributes for the navbar brand. | `[]`
`brandCssClass(string $value)` | CSS class for the navbar brand. | `'navbar-brand'`
`brandImage(string $value)` | Image for the navbar brand. | `''`
`brandImageAttributes(array $values)` | HTML attributes for the navbar brand image. | `[]`
`brandText(string $value)` | Text for the navbar brand. | `''`
`brandTextAttributes(array $values)` | HTML attributes for the navbar brand text. | `[]`
`brandUrl(string $value)` | URL for the navbar brand. | `''`
`burgerAttributes(array $values)` | HTML attributes for the navbar burger. | `[]`
`burgerCssClass(string $value)` | CSS class for the navbar burger. | `'navbar-burger'`
`buttonLinkAriaExpanded(string $value)` | The ARIA expanded attribute of the button link. | `'false'`
`buttonLinkAriaLabelText(string $value)` | The ARIA label text of the button link. | `'menu'`
`buttonLinkContent(string $value)` | The content of the button link. | `''`
`buttonLinkRole(string $value)` | The role of the button link. | `'button'`
`cssClass(string $value)` | CSS class for the navbar. | `'navbar'`
`id(string $value)` | Set the ID of the navbar. | `''`
`itemCssClass(string $value)` | CSS class for the navbar item. | `'navbar-item'`
`role(string $value)` | The role of the navbar. | `'navigation'`

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\Nav` class with the specified value.

Method | Description | Default
-------|-------------|---------
`activateParents()` | Activate parent menu items when the current menu item is activated. | `false`
`attributes(array $values)` | HTML attributes for the widget container | `[]`
`currentPath(string $value)` | Allows you to assign the current path of the url from request controller. | `''`
`enclosedByEndMenu()` | Align the menu items to the right. | `false`
`enclosedByStartMenu()` | Align the menu items to the left. | `false`
`items(array $value)` | The menu items. | `[]`
`withoutActivateItems()` |  Disable activate items according to whether their currentPath. | `false`

### Items structure is an array of the following structure

```php
[
    [
        'label' => '',
        'url' => '',
        'urlAttributes' => [],
        'dropdownAttributes' => [],
        'iconText' => '',
        'iconCssClass' => '',
        'iconAttributes' => [],
        'items' => [],
        'active' => false,
        'disable' => false,
        'visible' => false,
        'encode' => false,
    ],
]
