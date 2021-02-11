<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_key_exists;
use function implode;
use function is_array;

final class Nav extends Widget
{
    private bool $activateItems = true;
    private bool $activateParents = false;
    private string $currentPath = '';
    private bool $encodeLabels = true;
    private bool $encodeTags = false;
    private array $items = [];

    protected function run(): string
    {
        $items = [];

        foreach ($this->items as $item) {
            if (!isset($item['visible']) || $item['visible']) {
                $items[] = $this->renderItem($item);
            }
        }

        return implode("\n", $items);
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
     * When tags Labels HTML should not be encoded.
     *
     * @return $this
     */
    public function withoutEncodeLabels(): self
    {
        $new = clone $this;
        $new->encodeLabels = false;
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
     * - dropdownOptions: array, optional, the HTML options that will passed to the {@see Dropdown} widget.
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
     * Renders the given items as a dropdown.
     *
     * This method is called to create sub-menus.
     *
     * @param array $items the given items. Please refer to {@see Dropdown::items} for the array structure.
     * @param array $parentItem the parent item information. Please refer to {@see items} for the structure of this
     * array.
     *
     * @throws InvalidArgumentException
     *
     * @return string the rendering result.
     */
    private function renderDropdown(array $items, array $parentItem): string
    {
        $dropdown = Dropdown::widget()
            ->dividerClass('navbar-divider')
            ->itemClass('navbar-item')
            ->itemsClass('navbar-dropdown')
            ->withoutEncloseByContainer()
            ->items($items)
            ->itemsOptions(ArrayHelper::getValue($parentItem, 'dropdownOptions', []));

        if ($this->encodeLabels === false) {
            $dropdown = $dropdown->withoutEncodeLabels();
        }

        return $dropdown->render() . "\n";
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
                    $items[$i]['options'] ??= ['class' => ''];
                    Html::addCssClass($items[$i]['options'], ['active' => 'is-active']);
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
     * @param array|object|string $item the menu item to be checked
     *
     * @return bool whether the menu item is active
     */
    private function isItemActive($item): bool
    {
        if (isset($item['active'])) {
            return ArrayHelper::getValue($item, 'active');
        }

        return
            isset($item['url']) &&
            $this->currentPath !== '/' &&
            $item['url'] === $this->currentPath &&
            $this->activateItems;
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
     * Renders a widget's item.
     *
     * @param array $item the item to render.
     *
     * @throws InvalidArgumentException|JsonException
     *
     * @return string the rendering result.
     */
    private function renderItem(array $item): string
    {
        if (!isset($item['label'])) {
            throw new InvalidArgumentException('The "label" option is required.');
        }

        $dropdown = false;
        $this->encodeLabels = $item['encode'] ?? $this->encodeLabels;

        if ($this->encodeLabels) {
            $label = Html::encode($item['label']);
        } else {
            $label = $item['label'];
        }

        $iconOptions = [];

        $icon = $item['icon'] ?? '';

        if (array_key_exists('iconOptions', $item) && is_array($item['iconOptions'])) {
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
            $dropdown = true;

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

        /** @psalm-suppress ConflictingReferenceConstraint */
        if ($this->activateItems && $active) {
            Html::addCssClass($linkOptions, ['active' => 'is-active']);
        }

        if ($dropdown) {
            $dropdownOptions = ['class' => 'navbar-link', 'encode' => false];

            return
                Html::beginTag('div', $options) . "\n" .
                Html::a($label, $url, $dropdownOptions) . "\n" .
                $items .
                Html::endTag('div');
        }

        if ($this->encodeTags === false) {
            $linkOptions['encode'] = false;
        }

        return Html::a($label, $url, $linkOptions);
    }
}
