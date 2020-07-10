## Menu widget

[The Bulma menu](https://bulma.io/documentation/components/menu/) is a vertical navigation component.

<p align="center">
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

use \Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Menu;

/* Register assets in view */

$assetManager->register([
    BulmaAsset::class
]);

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
                    'iconOptions' => ['class' => 'icon']
                ],
                [
                    'label' => 'Logout',
                    'url' => 'site/logout',
                    'icon' => 'mdi mdi-logout',
                    'iconOptions' => ['class' => 'icon']
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

Method                            | Description                                  | Default
----------------------------------|----------------------------------------------|---------
`id(string $value)`               | Widget ID.                                   | `''`
`activateItems(bool $value)`      | Whether to automatically activate item its route matches the currently requested route. | `true`
`activateParents(bool $value)`    | Whether to activate parent menu items if any child menu item is active. | `false`
`activeCssClass(string $value)`   | The CSS class to be appended to the active menu item. | `is-active`
`brand(string $value)`            | Custom brand content. | `''`
`currentPath(string $value)`      | Allows you to assign the current path of the URL from request controller. | `''`
`encodeLabels(bool $value)`       | Whether the labels for menu items should be HTML-encoded. | `true`
`firstItemCssClass(string $value)`| The CSS class for the first item in the main menu or each submenu. | `''`
`hideEmptyItems(bool $value)`     | Whether to hide empty menu items. An empty menu item is one whose `url` option is not set and which has no
visible child menu items | `true`
`items(array $value)`             | List of menu items. | `[]`
`itemOptions(array $value)`       | List of HTML attributes shared by all menu. | `[]`
`labelTemplate(string $value)`    | The template used to render the body of a menu which is NOT a link. | `''`
`lastItemCssClass(string $value)` | The CSS class that will be assigned to the last item in the main menu or each submenu. | `''`
`linkTemplate(string $value)`     | The template used to render the body of a menu which is a link. | `<a href={url}>{icon}{label}</a>`
`options(array $value)`           | The HTML attributes for the menu's container tag. | `[]`
`subMenuTemplate(string $value)`  | The template used to render a list of sub-menus. | `<ul class = menu-list>\n{items}\n</ul>`

