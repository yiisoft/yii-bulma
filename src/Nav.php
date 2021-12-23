<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use ReflectionException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

use function implode;
use function is_array;

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
    private string $autoIdPrefix = 'w';
    private string $currentPath = '';
    private bool $enclosedByStartMenu = false;
    private bool $enclosedByEndMenu = false;
    private array $items = [];
    private string $hasDropdownCssClass = 'has-dropdown';
    private string $isHoverableCssClass = 'is-hoverable';
    private string $navBarDropdownCssClass = 'navbar-dropdown';
    private string $navBarEndCssClass = 'navbar-end';
    private string $navBarItemCssClass = 'navbar-item';
    private string $navBarLinkCssClass = 'navbar-link';
    private string $navBarMenuCssClass = 'navbar-menu';
    private string $navBarStartCssClass = 'navbar-start';

    /**
     * Returns a new instance with the specified attributes.
     *
     * @param array $value The HTML attributes for the widget container nav tag.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function attributes(array $value): self
    {
        $new = clone $this;
        $new->attributes = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified prefix to the automatically generated widget IDs.
     *
     * @param string $value The prefix to the automatically generated widget IDs.
     *
     * @return self
     */
    public function autoIdPrefix(string $value): self
    {
        $new = clone $this;
        $new->autoIdPrefix = $value;
        return $new;
    }

    /**
     * Whether to activate parent menu items when one of the corresponding child menu items is active.
     *
     * @return $this
     */
    public function activateParents(): self
    {
        $new = clone $this;
        $new->activateParents = true;
        return $new;
    }

    /**
     * Allows you to assign the current path of the url from request controller.
     *
     * @param string $value
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
     * List of items in the nav widget. Each array element represents a single  menu item which can be either a string
     * or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: bool, optional, whether the item should be on active state or not.
     * - dropdownAttributes: array, optional, the HTML options that will passed to the {@see Dropdown} widget.
     * - items: array|string, optional, the configuration array for creating a {@see Dropdown} widget, or a string
     *   representing the dropdown menu.
     * - encode: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for
     *   only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     *
     * @param array $value
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
     * Disable activate items according to whether their currentPath.
     *
     * @return $this
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
     * @throws ReflectionException
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
     * @throws ReflectionException
     *
     * @return string the rendering result.
     *
     * @link https://bulma.io/documentation/components/navbar/#dropdown-menu
     */
    private function renderDropdown(array $items): string
    {
        return Dropdown::widget()
            ->dividerCssClass('navbar-divider')
            ->dropdownCssClass('navbar-dropdown')
            ->dropdownItemCssClass('navbar-item')
            ->items($items)
            ->enclosedByContainer()
            ->render() . PHP_EOL;
    }

    /**
     * Check to see if a child item is active optionally activating the parent.
     *
     * @param array $items
     * @param bool $active should the parent be active too
     *
     * @return array
     *
     * {@see items}
     */
    private function isChildActive(array $items, bool &$active = false): array
    {
        /** @var array|string $child */
        foreach ($items as $i => $child) {
            /** @var string */
            $url = $child['url'] ?? '#';

            /** @var bool */
            $active = $child['active'] ?? false;

            if ($active === false && is_array($items[$i])) {
                $items[$i]['active'] = $this->isItemActive($url, $this->currentPath, $this->activateItems);
            }

            if ($this->activateParents) {
                $active = true;
            }

            /** @var array */
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
     * @param string $url
     * @param string $currentPath
     * @param bool $activateItems
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
                ->content(CustomTag::name('i')->class($iconCssClass)->content($iconText)->encode(false)->render())
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
     * @throws ReflectionException
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
                [$this->navBarItemCssClass, $this->hasDropdownCssClass, $this->isHoverableCssClass]
            );
            Html::addCssClass($urlAttributes, $this->navBarLinkCssClass);
            Html::addCssClass($dropdownAttributes, $this->navBarDropdownCssClass);

            $items = $this->isChildActive($items, $active);
            $dropdown = PHP_EOL . $this->renderDropdown($items);
            $a = A::tag()->attributes($urlAttributes)->content($itemLabel)->encode(false)->url($url)->render();
            $div = Div::tag()->attributes($dropdownAttributes)->content($dropdown)->encode(false)->render();
            $html = Div::tag()
                ->attributes($attributes)
                ->content(PHP_EOL . $a . PHP_EOL . $div . PHP_EOL)
                ->encode(false)
                ->render();
        }

        if ($html === '') {
            Html::addCssClass($urlAttributes, 'navbar-item');
            $html = A::tag()->attributes($urlAttributes)->content($itemLabel)->url($url)->encode(false)->render();
        }

        return $html;
    }

    /**
     * @throws ReflectionException
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

        $links = PHP_EOL . implode("\n", $items) . PHP_EOL;

        if ($this->enclosedByStartMenu) {
            $links = PHP_EOL . Div::tag()->class($this->navBarStartCssClass)->content($links)->encode(false)->render() .
                PHP_EOL;
        }

        if ($this->enclosedByEndMenu) {
            $links = PHP_EOL . Div::tag()->class($this->navBarEndCssClass)->content($links)->encode(false)->render() .
                PHP_EOL;
        }

        return $this->items !== []
             ? Div::tag()
                ->class($this->navBarMenuCssClass)
                ->content($links)
                ->encode(false)
                ->render()
             : '';
    }
}
