<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

use function implode;
use function is_array;
use function is_string;

/**
 * Nav renders a nav HTML component.
 *
 * @link https://bulma.io/documentation/components/navbar/#basic-navbar
 */
final class Nav extends Widget
{
    private bool $activateItems = true;
    private bool $activateParents = false;
    private array $attributes = [];
    private string $currentPath = '';
    private string $dropdownCssClass = 'navbar-dropdown';
    private string $endCssClass = 'navbar-end';
    private bool $enclosedByStartMenu = false;
    private bool $enclosedByEndMenu = false;
    private string $hasDropdownCssClass = 'has-dropdown';
    private string $isHoverableCssClass = 'is-hoverable';
    private string $itemCssClass = 'navbar-item';
    private array $items = [];
    private string $linkCssClass = 'navbar-link';
    private string $menuCssClass = 'navbar-menu';
    private string $startCssClass = 'navbar-start';

    /**
     * Returns a new instance with the specified HTML attributes for widget.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} For details on how attributes are being rendered.
     */
    public function attributes(array $values): self
    {
        $new = clone $this;
        $new->attributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified whether to activate parent menu items when one of the corresponding
     * child menu items is active.
     *
     * @return self
     */
    public function activateParents(): self
    {
        $new = clone $this;
        $new->activateParents = true;
        return $new;
    }

    /**
     * Returns a new instance with the specified allows you to assign the current path of the url from request
     * controller.
     *
     * @param string $value The current path.
     *
     * @return self
     */
    public function currentPath(string $value): self
    {
        $new = clone $this;
        $new->currentPath = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified align the menu items to the right.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/navbar/#navbar-start-and-navbar-end
     */
    public function enclosedByEndMenu(): self
    {
        $new = clone $this;
        $new->enclosedByEndMenu = true;
        return $new;
    }

    /**
     * Returns a new instance with the specified align the menu items to left.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/navbar/#navbar-start-and-navbar-end
     */
    public function enclosedByStartMenu(): self
    {
        $new = clone $this;
        $new->enclosedByStartMenu = true;
        return $new;
    }

    /**
     * Returns a new instance with the specified items.
     *
     * Each array element represents a single  menu item which can be either a string
     * or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - urlAttributes: optional, the attributes to be rendered in the item's URL.
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - linkAttributes: array, optional, the HTML attributes of the item's link.
     * - active: bool, optional, whether the item should be on active state or not.
     * - disable: bool, optional, whether the item should be disabled.
     * - dropdownAttributes: array, optional, the HTML options that will be passed to the {@see Dropdown} widget.
     * - items: array|string, optional, the configuration array for creating a {@see Dropdown} widget, or a string
     *   representing the dropdown menu.
     * - encode: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for
     *   only this item.
     * - iconAttributes: array, optional, the HTML attributes of the item's icon.
     * - iconCssClass: string, optional, the icon CSS class.
     * - iconText: string, optional, the icon text.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     *
     * @param array $value The menu items.
     *
     * @return self
     */
    public function items(array $value): self
    {
        $new = clone $this;
        $new->items = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified disable activate items according to whether their currentPath.
     *
     * @return self
     *
     * {@see isItemActive}
     */
    public function withoutActivateItems(): self
    {
        $new = clone $this;
        $new->activateItems = false;
        return $new;
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    protected function run(): string
    {
        return $this->renderNav();
    }

    /**
     * Renders the given items as a dropdown.
     *
     * This method is called to create sub-menus.
     *
     * @param array $items the given items. Please refer to {@see Dropdown::items} for the array structure.
     *
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     *
     * @return string the rendering result.
     *
     * @link https://bulma.io/documentation/components/navbar/#dropdown-menu
     */
    private function renderDropdown(array $items): string
    {
        return Dropdown::widget()
                ->cssClass('navbar-dropdown')
                ->dividerCssClass('navbar-divider')
                ->enclosedByContainer()
                ->itemCssClass('navbar-item')
                ->items($items)
                ->render() . PHP_EOL;
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     *
     * @param array $items {@see items}
     * @param bool $active Should the parent be active too.
     *
     * @return array
     *
     * {@see items}
     */
    private function isChildActive(array $items, bool &$active = false): array
    {
        /**
         * @psalm-var array<
         *  string,
         *  array{
         *    active?: bool,
         *    disable?: bool,
         *    encode?: bool,
         *    icon?: string,
         *    iconAttributes?: array,
         *    items?: array,
         *    label: string,
         *    url: string,
         *    visible?: bool
         * }|string> $items
         */
        foreach ($items as $i => $child) {
            $url = $child['url'] ?? '#';
            $active = $child['active'] ?? false;

            if ($active === false && is_array($child)) {
                $child['active'] = $this->isItemActive($url, $this->currentPath, $this->activateItems);
            }

            if ($this->activateParents) {
                $active = true;
            }

            $childItems = $child['items'] ?? [];

            if ($childItems !== [] && is_array($items[$i])) {
                $items[$i]['items'] = $this->isChildActive($childItems);

                if ($active) {
                    $items[$i]['attributes'] = ['active' => true];
                    $active = true;
                }
            }
        }

        return $items;
    }

    /**
     * Checks whether a menu item is active.
     *
     * This is done by checking if {@see currentPath} match that specified in the `url` option of the menu item. When
     * the `url` option of a menu item is specified in terms of an array, its first element is treated as the
     * currentPath for the item and the rest of the elements are the associated parameters. Only when its currentPath
     * and parameters match {@see currentPath}, respectively, will a menu item be considered active.
     *
     * @param string $url The menu item's URL.
     * @param string $currentPath The currentPath.
     * @param bool $activateItems Whether to activate the parent menu items when the currentPath matches.
     *
     * @return bool whether the menu item is active
     */
    private function isItemActive(string $url, string $currentPath, bool $activateItems): bool
    {
        return ($currentPath !== '/') && ($url === $currentPath) && $activateItems;
    }

    private function renderLabelItem(
        string $label,
        string $iconText,
        string $iconCssClass,
        array $iconAttributes = []
    ): string {
        $html = '';

        if ($iconText !== '' || $iconCssClass !== '') {
            $html = Span::tag()
                ->attributes($iconAttributes)
                ->content(CustomTag::name('i')
                    ->class($iconCssClass)
                    ->content($iconText)
                    ->encode(false)
                    ->render())
                ->encode(false)
                ->render();
        }

        if ($label !== '') {
            $html .= $label;
        }

        return $html;
    }

    /**
     * Renders a widget's item.
     *
     * @param array $item the item to render.
     *
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     *
     * @return string the rendering result.
     */
    private function renderItem(array $item): string
    {
        $html = '';

        if (!isset($item['label'])) {
            throw new InvalidArgumentException('The "label" option is required.');
        }

        /** @var string */
        $itemLabel = $item['label'] ?? '';

        if (isset($item['encode']) && $item['encode'] === true) {
            $itemLabel = Html::encode($itemLabel);
        }

        /** @var array */
        $items = $item['items'] ?? [];

        /** @var string */
        $url = $item['url'] ?? '#';

        /** @var array */
        $urlAttributes = $item['urlAttributes'] ?? [];

        /** @var array */
        $dropdownAttributes = $item['dropdownAttributes'] ?? [];

        /** @var string */
        $iconText = $item['iconText'] ?? '';

        /** @var string */
        $iconCssClass = $item['iconCssClass'] ?? '';

        /** @var array */
        $iconAttributes = $item['iconAttributes'] ?? [];

        /** @var bool */
        $active = $item['active'] ?? $this->isItemActive($url, $this->currentPath, $this->activateItems);

        /** @var bool */
        $disabled = $item['disabled'] ?? false;

        $itemLabel = $this->renderLabelItem($itemLabel, $iconText, $iconCssClass, $iconAttributes);

        if ($disabled) {
            Html::addCssStyle($urlAttributes, 'opacity:.65; pointer-events:none;');
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($urlAttributes, ['active' => 'is-active']);
        }

        if ($items !== []) {
            $attributes = $this->attributes;
            Html::addCssClass(
                $attributes,
                [$this->itemCssClass, $this->hasDropdownCssClass, $this->isHoverableCssClass]
            );
            Html::addCssClass($urlAttributes, $this->linkCssClass);
            Html::addCssClass($dropdownAttributes, $this->dropdownCssClass);

            $items = $this->isChildActive($items, $active);
            $dropdown = PHP_EOL . $this->renderDropdown($items);
            $a = A::tag()
                ->attributes($urlAttributes)
                ->content($itemLabel)
                ->encode(false)
                ->url($url)
                ->render();
            $div = Div::tag()
                ->attributes($dropdownAttributes)
                ->content($dropdown)
                ->encode(false)
                ->render();
            $html = Div::tag()
                ->attributes($attributes)
                ->content(PHP_EOL . $a . PHP_EOL . $div . PHP_EOL)
                ->encode(false)
                ->render();
        }

        if ($html === '') {
            Html::addCssClass($urlAttributes, 'navbar-item');
            $html = A::tag()
                ->attributes($urlAttributes)
                ->content($itemLabel)
                ->url($url)
                ->encode(false)
                ->render();
        }

        return $html;
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    private function renderNav(): string
    {
        $items = [];

        /** @var array|string $item */
        foreach ($this->items as $item) {
            $visible = !isset($item['visible']) || $item['visible'];

            if ($visible) {
                $items[] = is_string($item) ? $item : $this->renderItem($item);
            }
        }

        $links = PHP_EOL . implode(PHP_EOL, $items) . PHP_EOL;

        if ($this->enclosedByStartMenu) {
            $links = PHP_EOL . Div::tag()
                    ->class($this->startCssClass)
                    ->content($links)
                    ->encode(false)
                    ->render() .
                PHP_EOL;
        }

        if ($this->enclosedByEndMenu) {
            $links = PHP_EOL . Div::tag()
                    ->class($this->endCssClass)
                    ->content($links)
                    ->encode(false)
                    ->render() .
                PHP_EOL;
        }

        return $this->items !== []
            ? Div::tag()
                ->class($this->menuCssClass)
                ->content($links)
                ->encode(false)
                ->render()
            : '';
    }
}
