<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Widget\Exception\InvalidConfigException;

use function implode;
use function is_array;

final class Nav extends Widget
{
    private bool $activateItems = true;
    private bool $activateParents = false;
    private string $currentPath = '';
    private bool $dropdown = false;
    private bool $encodeLabels = true;
    private array $items = [];

    protected function run(): string
    {
        $html = $this->renderItems();

        if ($this->dropdown) {
            $html .= Html::endTag('div');
        }

        return $html;
    }

    /**
     * Whether to automatically activate items according to whether their currentPath matches the currently requested.
     *
     * @param bool $value
     *
     * @return self
     *
     * {@see isItemActive}
     */
    public function activateItems(bool $value): self
    {
        $this->activateItems = $value;
        return $this;
    }

    /**
     * Whether to activate parent menu items when one of the corresponding child menu items is active.
     *
     * @param bool $value
     *
     * @return self
     */
    public function activateParents(bool $value): self
    {
        $this->activateParents = $value;
        return $this;
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
        $this->currentPath = $value;
        return $this;
    }

    /**
     * Whether the nav items labels should be HTML-encoded.
     *
     * @param bool $value
     *
     * @return self
     */
    public function encodeLabels(bool $value): self
    {
        $this->encodeLabels = $value;
        return $this;
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
     * - dropdownOptions: array, optional, the HTML options that will passed to the {@see Dropdown} widget.
     * - items: array|string, optional, the configuration array for creating a {@see Dropdown} widget, or a string
     *   representing the dropdown menu.
     * - encode: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for
     *   only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     *
     * @param array $value
     * @return Nav
     */
    public function items(array $value): self
    {
        $this->items = $value;
        return $this;
    }

    /**
     * Renders the given items as a dropdown.
     *
     * This method is called to create sub-menus.
     *
     * @param array $items the given items. Please refer to {@see Dropdown::items} for the array structure.
     * @param array $parentItem the parent item information. Please refer to {@see items} for the structure of this
     * array.
     *
     * @return string the rendering result.
     */
    private function renderDropdown(array $items, array $parentItem): string
    {
        return Dropdown::widget()
            ->cssDivider('navbar-divider')
            ->cssItem('navbar-item')
            ->cssItems('navbar-dropdown')
            ->enclosedByContainer(false)
            ->encodeLabels($this->encodeLabels)
            ->items($items)
            ->optionsItems(ArrayHelper::getValue($parentItem, 'dropdownOptions', []))
            ->render() . "\n";
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
    private function isChildActive(array $items, bool &$active): array
    {
        foreach ($items as $i => $child) {
            if ($this->isItemActive($child)) {
                ArrayHelper::setValue($items[$i], 'active', true);
                if ($this->activateParents) {
                    $active = $this->activateParents;
                }
            }

            if (is_array($child) && ($childItems = ArrayHelper::getValue($child, 'items')) && is_array($childItems)) {
                $activeParent = false;
                $items[$i]['items'] = $this->isChildActive($childItems, $activeParent);

                if ($activeParent) {
                    Html::addCssClass($items[$i]['options'], 'active');
                    $active = $activeParent;
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
     * @param array|string $item the menu item to be checked
     *
     * @return bool whether the menu item is active
     */
    private function isItemActive($item): bool
    {
        if (isset($item['active'])) {
            return ArrayHelper::getValue($item, 'active');
        }

        if (isset($item['url']) && $this->currentPath !== '/' && $item['url'] === $this->currentPath && $this->activateItems) {
            return true;
        }

        return false;
    }

    private function renderIcon(string $label, string $icon, array $iconOptions): string
    {
        if ($icon !== '') {
            $label = Html::beginTag('span', $iconOptions) .
                Html::tag('i', '', ['class' => $icon]) .
                Html::endTag('span') .
                Html::tag('span', $label);
        }

        return $label;
    }

    /**
     * Renders widget items.
     *
     * @throws InvalidConfigException
     *
     * @return string
     */
    private function renderItems(): string
    {
        $items = [];

        foreach ($this->items as $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }

            $items[] = $this->renderItem($item);
        }

        return implode("\n", $items);
    }

    /**
     * Renders a widget's item.
     *
     * @param array $item the item to render.
     *
     * @return string the rendering result.
     *
     * @throws InvalidConfigException
     */
    private function renderItem(array $item): string
    {
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }

        $this->encodeLabels = $item['encode'] ?? $this->encodeLabels;

        if ($this->encodeLabels) {
            $label = Html::encode($item['label']);
        } else {
            $label = $item['label'];
        }

        $icon = '';
        $iconOptions = [];

        if (isset($item['icon'])) {
            $icon = $item['icon'];
        }

        if (isset($item['iconOptions']) && is_array($item['iconOptions'])) {
            $iconOptions = $this->addOptions($iconOptions, 'icon');
        }

        $label = $this->renderIcon($label, $icon, $iconOptions);

        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $disabled = ArrayHelper::getValue($item, 'disabled', false);

        $active = $this->isItemActive($item);

        if (isset($items)) {
            $this->dropdown = true;

            Html::addCssClass($options, 'navbar-item has-dropdown is-hoverable');

            if (is_array($items)) {
                $items = $this->isChildActive($items, $active);
                $items = $this->renderDropdown($items, $item);
            }
        }

        Html::addCssClass($linkOptions, 'navbar-item');

        if ($disabled) {
            Html::addCssStyle($linkOptions, 'opacity:.65; pointer-events:none;');
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($linkOptions, 'is-active');
        }


        if ($this->dropdown) {
            return
                html::beginTag('div', $options) . "\n" .
                    Html::a($label, $url, ['class' => 'navbar-link']) . "\n" .
                    $items;
        }

        return Html::a($label, $url, $linkOptions);
    }
}
