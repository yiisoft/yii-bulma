# Menu widget

### [The Bulma menu](https://bulma.io/documentation/components/menu/) is a vertical navigation component.

<p align="center">
    </br>
    <img src="images/menu.png">
</p>

HTML generated consists of:
- The `menu` container.
- Informative `menu-label` labels.
- Interactive `menu-list` lists that can be nested up to 2 levels.

## Usage

```php
/**
 * @var Yiisoft\Assets\AssetManager $assetManager
 * @var Yiisoft\View\WebView $this
 */

use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Menu;

/* Register assets in view */

$assetManager->register(BulmaAsset::class);

$this->setCssFiles($assetManager->getCssFiles());
$this->setJsFiles($assetManager->getJsFiles());
?>

<?= Menu::widget()
    ->brand(
        '<div class=aside-tools>' . "\n" . '<div class=aside-tools-label>' . "\n" .
        '<span><b>Brand</b> Example</span>' . "\n" . '</div>' . "\n" . '</div>'
    )
    ->currentPath('site/index')
    ->items([
        ['label' => 'General',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'url' => 'site/index',
                    'icon' => 'mdi mdi-desktop-mac',
                    'iconAttributes' => ['class' => 'icon']
                ],
                [
                    'label' => 'Logout',
                    'url' => 'site/logout',
                    'icon' => 'mdi mdi-logout',
                    'iconAttributes' => ['class' => 'icon']
                ],
            ]
        ],
        ['label' => 'Users',
            'items' => [
                ['label' => 'Manager', 'url' => 'user/index'],
                ['label' => 'Export', 'url' => 'user/export']
            ]
        ],
    ])
    ->render() ?>
```

HTML produced is like the following:

```html
<aside class="menu">
    <div class=aside-tools>
        <div class=aside-tools-label>
            <span><b>Brand</b> Example</span>
        </div>
    </div>
    <ul class="menu-list">
        <p class="menu-label">General</p>
        <ul class = menu-list>
            <li>
                <a href="site/index" class="is-active">
                    <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>Dashboard
                </a>
            </li>
            <li>
                <a href="site/logout">
                    <span class="icon"><i class="mdi mdi-logout"></i></span>Logout
                </a>
            </li>
        </ul>
        <p class="menu-label">Users</p>
        <ul class = menu-list>
            <li><a href="user/index">Manager</a></li>
            <li><a href="user/export">Export</a></li>
        </ul>
    </ul>
</aside>
```

Method | Description | Default
-------|-------------|---------
`activateParents()` | Whether to activate parent menu items when one of the corresponding child menu items is active. | `true`
`activeCssClass(string $value)` | The CSS class to be appended to the active menu item. | `is-active`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`attributes(array $value)` | HTML attributes for the widget container nav tag. | `[]`
`brand(string $value)` | Custom brand content. | `''`
`currentPath(string $value)` | Allows you to assign the current path of the URL from request controller. | `''`
`deactivateItems()` | Disable active items according to their current path. | `false`
`firstItemCssClass(string $value)` | The CSS class for the first item in the main menu or each submenu. | `''`
`hiddenEmptyItems()` | Whether to hide empty menu items. | `false`
`id(string $value)` | Widget ID. | `''`
`itemAttributes(array $value)` | List of HTML attributes shared by all menu. | `[]`
`items(array $value)` | List of menu items. | `[]`
`itemsTag(?string $value)` | Tag name of the container element, `null` value means that container tag will not be rendered. | `ul`
`labelTemplate(string $value)`| The template used to render the body of a menu which is NOT a link. | `''`
`lastItemCssClass(string $value)` | The CSS class that will be assigned to the last item in the main menu or each submenu. | `''`
`subMenuTemplate(string $value)` | The template used to render a list of sub-menus. | `<ul class = menu-list>\n{items}\n</ul>`
`urlTemplate(string $value)` | The template used to render the body of a menu which is a link. | `<a href={url}>{icon}{label}</a>`

### Items structure is an array of the following structure:

```php
[
    [
        'label' => '',
        'labelTemplate' => '',
        'url' => '',
        'urlAttributes' => [],
        'urlTemplate' => '',
        'items' => [],
        'itemAtrributes' => [],
        'icon' => '',,
        'iconAttributes' => [],
        'active' => false,
        'submenuTemplate' => '',
        'encode' => false,
        'visible' => true,
    ],
]
