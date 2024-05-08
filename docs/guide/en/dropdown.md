# Dropdown widget

### [The dropdown component](https://bulma.io/documentation/components/dropdown/) is a container for a dropdown button and a dropdown menu.

<p align="center">
    </br>
    <img src="../../images/dropdown.png">
</p>

HTML generated consists of:

- `dropdown` the main container.
- `dropdown-trigger` the container for a button.
- `dropdown-menu` the toggleable menu, hidden by default.
- `dropdown-content` the dropdown box, with a white background and a shadow.
- `dropdown-item` each single item of the dropdown, which can either be a a or a div.
- `dropdown-divider` a horizontal line to separate dropdown items.

## Usage

```php
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

<?= Dropdown::widget()
    ->buttonLabel('Russian cities')
    ->items([
        ['label' => 'San petesburgo', 'url' => '#'],
        ['label' => 'Moscu', 'url' => '#'],
        ['label' => 'Novosibirsk', 'url' => '#'],
        '-',
        ['label' => 'Ekaterinburgo', 'url' => '#'],
    ])
    ->render();
?>
```

The code above generates the following HTML:

```html
<div class="dropdown">
    <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
            <span>Russian cities</span>
            <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
    </div>
    <div id="w1-dropdown" class="dropdown-menu">
        <div class="dropdown-content">
            <a class="dropdown-item" href="#">San petesburgo</a>
            <a class="dropdown-item" href="#">Moscu</a>
            <a class="dropdown-item" href="#">Novosibirsk</a>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="#">Ekaterinburgo</a>
        </div>
    </div>
</div>
```

## Setters

All setters are immutable and return a new instance of the `Yiisoft\Yii\Bulma\Dropdown` class with the specified value.

Method | Description | Default
-------|-------------|---------
`attributes(array $value)` | Sets the HTML attributes for the dropdown container. | `[]`
`autoIdPrefix(string $value)` | Prefix to the automatically generated widget ID. | `w`
`buttonAttributes(array $values)` | The HTML attributes for the dropdown button. | `[]`
`buttonIconAttributes(array $values)` | The HTML attributes for the dropdown button icon. | `['class' => 'icon is-small']`
`buttonIconCssClass(string $value)` | Set icon CSS class for the dropdown button. | `''`
`buttonIconText(string $value)` | Set icon text for the dropdown button. | `'&#8595;'`
`buttonLabel(string $value)` | Set label for the dropdown button. | `'Click Me'`
`buttonLabelAttributes(array $values)` | The HTML attributes for the dropdown button label. | `[]`
`contentCssClass(string $value)` | Set CSS class for dropdown content. | `'dropdown-content'`
`cssClass(string $value)` | Set CSS class for the dropdown container. | `'dropdown'`
`dividerCssClass(string $value)` | Set CSS class for horizontal line separating dropdown items. | `'dropdown-divider'`
`enclosedByContainer(bool $value = false)` | Whether the widget should be enclosed by a container. | `true`
`id(string $value)` | Set the ID of the dropdown. | `''`
`itemActiveCssClass(string $value)` | Set CSS class for active dropdown item. | `'is-active'`
`itemCssClass(string $value)` | Set CSS class for dropdown item. | `'dropdown-item'`
`itemDisabledStyleCss(string $value)` | Set Style attributes for disabled dropdown item. | `'opacity:.65;pointer-events:none;'`
`itemHeaderCssClass(string $value)` | Set CSS class for dropdown item header. | `'dropdown-header'`
`items(array $value)` | Set the dropdown items. | `[]`
`menuCssClass(string $value)` | Set CSS class for dropdown menu. | `'dropdown-menu'`
`submenu(bool $value)` | Set whether the dropdown is a submenu. | `false`
`submenuAttributes(array $values)` | The HTML attributes for the dropdown submenu. | `[]`
`triggerCssClass(string $value)` | Set CSS class for dropdown trigger. | `'dropdown-trigger'`

### Items structure is an array of the following structure:

```php
[
    [
        'label' => '',
        'url' => '',
        'urlAttributes' => [],
        'iconText' => '',
        'iconCssClass' => '',
        'iconAttributes' => [],
        'active' => false,
        'disabled' => false,
        'enclose' => false,
        'submenu' => false,
    ],
]
