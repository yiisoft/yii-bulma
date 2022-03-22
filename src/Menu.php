<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\I;
use Yiisoft\Html\Tag\P;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

use function array_merge;
use function count;
use function implode;
use function strtr;

/**
 * The Bulma menu is a vertical navigation component.
 *
 * @link https://bulma.io/documentation/components/menu/
 */
final class Menu extends Widget
{
    private string $autoIdPrefix = 'w';
    private array $attributes = [];
    private string $activeCssClass = 'is-active';
    private bool $activateItems = true;
    private bool $activateParents = false;
    private string $brand = '';
    private string $currentPath = '';
    private string $firstItemCssClass = '';
    private bool $hiddenEmptyItems = false;
    private string $menuClass = 'menu';
    private string $menuListClass = 'menu-list';
    private array $items = [];
    private array $itemAttributes = [];
    private array $itemsAttributes = [];
    /** @psalm-var null|non-empty-string $itemsTag */
    private ?string $itemsTag = 'li';
    private string $lastItemCssClass = '';
    private string $urlTemplate = '<a href={url}>{icon}{label}</a>';
    private string $labelTemplate = '{label}';
    private bool $encodeLabels = true;
    private string $subMenuTemplate = "<ul class = menu-list>\n{items}\n</ul>";

    /**
     * Returns a new instance with the activated parent items.
     *
     * Activates parent menu items when one of the corresponding child menu items is active.
     * The activated parent menu items will also have its CSS classes appended with {@see activeCssClass()}.
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
     * Returns a new instance with the specified active CSS class.
     *
     * @param string $value The CSS class to be appended to the active menu item.
     *
     * @return self
     */
    public function activeCssClass(string $value): self
    {
        $new = clone $this;
        $new->activeCssClass = $value;
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
     * The HTML attributes. The following special attributes are recognized.
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
     * Returns a new instance with the specified HTML code of brand.
     *
     * @param string $value The HTML code of brand.
     *
     * @return self
     */
    public function brand(string $value): self
    {
        $new = clone $this;
        $new->brand = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified current path.
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
     * Disables active items according to their current path and returns a new instance.
     *
     * @return self
     *
     * {@see isItemActive}
     */
    public function deactivateItems(): self
    {
        $new = clone $this;
        $new->activateItems = false;
        return $new;
    }

    /**
     * Returns a new instance with the specified first item CSS class.
     *
     * @param string $value The CSS class that will be assigned to the first item in the main menu or each submenu.
     *
     * @return self
     */
    public function firstItemCssClass(string $value): self
    {
        $new = clone $this;
        $new->firstItemCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified hidden empty items.
     *
     * @param bool $value Whether to hide empty menu items.
     *
     * @return self
     */
    public function hiddenEmptyItems(): self
    {
        $new = clone $this;
        $new->hiddenEmptyItems = true;
        return $new;
    }

    /**
     * Returns a new instance with the specified ID of the widget.
     *
     * @param string $value The ID of the widget.
     *
     * @return self
     */
    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified item attributes.
     *
     * @param array $value List of HTML attributes shared by all menu {@see items}. If any individual menu item
     * specifies its  `attributes`, it will be merged with this property before being used to generate the HTML
     * attributes for the menu item tag. The following special attributes are recognized:
     *
     * @return self
     *
     * {@see Html::renderTagAttributes() For details on how attributes are being rendered}
     */
    public function itemAttributes(array $value): self
    {
        $new = clone $this;
        $new->itemAttributes = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified items.
     *
     * @param array $value List of menu items. Each menu item should be an array of the following structure:
     *
     * - label: string, optional, specifies the menu item label. When {@see encodeLabels} is true, the label will be
     *   HTML-encoded. If the label is not specified, an empty string will be used.
     * - encode: bool, optional, whether this item`s label should be HTML-encoded. This param will override global
     *   {@see encodeLabels} param.
     * - url: string or array, optional, specifies the URL of the menu item. When this is set, the actual menu item
     *   content will be generated using {@see urlTemplate}; otherwise, {@see labelTemplate} will be used.
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - items: array, optional, specifies the sub-menu items. Its format is the same as the parent items.
     * - active: bool or Closure, optional, whether this menu item is in active state (currently selected). When
     *   using a closure, its signature should be `function ($item, $hasActiveChild, $isItemActive, $Widget)`. Closure
     *   must return `true` if item should be marked as `active`, otherwise - `false`. If a menu item is active, its CSS
     *   class will be appended with {@see activeCssClass}. If this option is not set, the menu item will be set active
     *   automatically when the current request is triggered by `url`. For more details, please refer to
     *   {@see isItemActive()}.
     * - labeltemplate: string, optional, the template used to render the content of this menu item. The token `{label}`
     *   will be replaced by the label of the menu item. If this option is not set, {@see labelTemplate} will be used
     *   instead.
     * - urltemplate: string, optional, the template used to render the content of this menu item. The token `{url}`
     *   will be replaced by the URL associated with this menu item. If this option is not set, {@see urlTemplate} will
     *   be used instead.
     * - subMenuTemplate: string, optional, the template used to render the list of sub-menus. The token `{items}` will
     *   be replaced with the rendered sub-menu items. If this option is not set, {@see subMenuTemplate} will be used
     *   instead.
     * - itemAttributes: array, optional, the HTML attributes for the item container tag.
     * - icon: string, optional, class icon.
     * - iconAttributes: array, optional, the HTML attributes for the container icon.
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
     * Return a new instance with tag for item container.
     *
     * @param string|null $value The tag for item container, `null` value means that container tag will not be rendered.
     *
     * @return self
     */
    public function itemsTag(?string $value): self
    {
        if ($value === '') {
            throw new InvalidArgumentException('Tag for item container cannot be empty.');
        }

        $new = clone $this;
        $new->itemsTag = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified label template.
     *
     * @param string $value The template used to render the body of a menu which is NOT a link.
     *
     * In this template, the token `{label}` will be replaced with the label of the menu item.
     *
     * This property will be overridden by the `template` option set in individual menu items via {@see items}.
     *
     * @return self
     */
    public function labelTemplate(string $value): self
    {
        $new = clone $this;
        $new->labelTemplate = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified last item CSS class.
     *
     * @param string $value The CSS class that will be assigned to the last item in the main menu or each submenu.
     *
     * @return self
     */
    public function lastItemCssClass(string $value): self
    {
        $new = clone $this;
        $new->lastItemCssClass = $value;
        return $new;
    }

    /**
     * The template used to render a list of sub-menus.
     *
     * In this template, the token `{items}` will be replaced with the rendered sub-menu items.
     *
     * @param string $value
     *
     * @return self
     */
    public function subMenuTemplate(string $value): self
    {
        $new = clone $this;
        $new->subMenuTemplate = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified link template.
     *
     * @param string $value The template used to render the body of a menu which is a link. In this template, the token
     * `{url}` will be replaced with the corresponding link URL; while `{label}` will be replaced with the link text.
     *
     * This property will be overridden by the `template` option set in individual menu items via {@see items}.
     *
     * @return self
     */
    public function urlTemplate(string $value): self
    {
        $new = clone $this;
        $new->urlTemplate = $value;
        return $new;
    }

    /**
     * Renders the menu.
     *
     * @throws JsonException
     *
     * @return string the result of Widget execution to be outputted.
     */
    protected function run(): string
    {
        $items = $this->normalizeItems($this->items);

        if (empty($items)) {
            return '';
        }

        return $this->renderMenu($items);
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
    private function normalizeItems(array $items, bool &$active = false): array
    {
        /**
         * @psalm-var array<
         *  string,
         *  array{
         *    active?: bool,
         *    attributes?: array,
         *    encode?: bool,
         *    icon?: string,
         *    iconAttributes?: array,
         *    items?: array,
         *    label: string,
         *    labelTemplate?: string,
         *    urlTemplate?: string,
         *    subMenuTemplate?: string,
         *    url: string,
         *    visible?: bool
         * }> $items
         */
        foreach ($items as $i => $child) {
            if (isset($child['items']) && $child['items'] === [] && $this->hiddenEmptyItems) {
                unset($items[$i]);
                continue;
            }

            $url = $child['url'] ?? '#';
            $active = $child['active'] ?? false;

            if ($active === false) {
                $child['active'] = $this->isItemActive($url, $this->currentPath, $this->activateItems);
            }

            if ($this->activateParents) {
                $active = true;
            }

            $childItems = $child['items'] ?? [];

            if ($childItems !== []) {
                $items[$i]['items'] = $this->normalizeItems($childItems);

                if ($active) {
                    $items[$i]['active'] = true;
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

    /**
     * @throws JsonException
     */
    private function renderItems(array $items): string
    {
        $lines = [];
        $n = count($items);

        /** @psalm-var array<array-key, array> $items */
        foreach ($items as $i => $item) {
            /** @var array */
            $subItems = $item['items'] ?? [];

            /** @var string */
            $url = $item['url'] ?? '';

            /** @var array */
            $attributes = $item['itemAttributes'] ?? [];

            /** @var array */
            $linkAttributes = $item['linkAttributes'] ?? [];
            $attributes = array_merge($this->itemAttributes, $attributes);

            if ($i === 0 && $this->firstItemCssClass !== '') {
                Html::addCssClass($attributes, $this->firstItemCssClass);
            }

            if ($i === $n - 1 && $this->lastItemCssClass !== '') {
                Html::addCssClass($attributes, $this->lastItemCssClass);
            }

            if (array_key_exists('tag', $item)) {
                /** @psalm-var null|non-empty-string */
                $tag = $item['tag'];
            } else {
                $tag = $this->itemsTag;
            }

            /** @var bool */
            $active = $item['active'] ?? $this->isItemActive($url, $this->currentPath, $this->activateItems);

            if ($active) {
                Html::addCssClass($linkAttributes, $this->activeCssClass);
            }

            $menu = $this->renderItem($item, $linkAttributes);

            if ($subItems !== []) {
                /** @var string */
                $subMenuTemplate = $item['subMenuTemplate'] ?? $this->subMenuTemplate;
                $menu .= strtr($subMenuTemplate, ['{items}' => $this->renderItems($subItems)]);
            }

            if (isset($item['label']) && !isset($item['url'])) {
                if (!empty($menu)) {
                    $lines[] = $menu;
                } else {
                    /** @var string */
                    $lines[] = $item['label'];
                }
            } elseif (!empty($menu)) {
                $lines[] = $tag === null
                ? $menu
                : Html::tag($tag, $menu, $attributes)->encode(false)->render();
            }
        }

        return implode("\n", $lines);
    }

    /**
     * @throws JsonException
     */
    private function renderItem(array $item, array $linkAttributes): string
    {
        /** @var bool */
        $visible = $item['visible'] ?? true;

        if ($visible === false) {
            return '';
        }

        /** @var bool */
        $encode = $item['encode'] ?? true;

        /** @var string */
        $label = $item['label'] ?? '';

        if ($encode) {
            $label = Html::encode($label);
        }

        /** @var string */
        $labelTemplate = $item['labelTemplate'] ?? $this->labelTemplate;

        if (isset($item['url'])) {
            /** @var string */
            $urlTemplate = $item['urlTemplate'] ?? $this->urlTemplate;

            $htmlIcon = '';

            /** @var string|null */
            $icon = $item['icon'] ?? null;

            /** @var array */
            $iconAttributes = $item['iconAttributes'] ?? [];

            if ($icon !== null) {
                $htmlIcon = $this->renderIcon($icon, $iconAttributes);
            }

            if ($linkAttributes !== []) {
                $url = '"' . Html::encode($item['url']) . '"' . Html::renderTagAttributes($linkAttributes);
            } else {
                $url = '"' . Html::encode($item['url']) . '"';
            }

            return strtr($urlTemplate, ['{url}' => $url, '{label}' => $label, '{icon}' => $htmlIcon]);
        }

        return strtr(
            $labelTemplate,
            ['{label}' => P::tag()->class('menu-label')->content($label)->render() . PHP_EOL]
        );
    }

    private function renderIcon(string $icon, array $iconAttributes): string
    {
        return $icon !== ''
            ? Span::tag()
                ->attributes($iconAttributes)
                ->content(I::tag()->class($icon)->render())
                ->encode(false)
                ->render()
            : '';
    }

    /**
     * @throws JsonException
     */
    private function renderMenu(array $items): string
    {
        $attributes = $this->attributes;
        $content = '';
        $customTag = CustomTag::name('aside');
        $itemsAttributes = $this->itemsAttributes;

        if (!array_key_exists('id', $attributes)) {
            $customTag = $customTag->id(Html::generateId($this->autoIdPrefix) . '-menu');
        }

        Html::addCssClass($attributes, $this->menuClass);
        Html::addCssClass($itemsAttributes, $this->menuListClass);

        if ($this->brand !== '') {
            $content .= PHP_EOL . $this->brand;
        }

        $content .= PHP_EOL . Html::openTag('ul', $itemsAttributes);
        $content .= PHP_EOL . $this->renderItems($items) . PHP_EOL;
        $content .= Html::closeTag('ul') . PHP_EOL;

        return $customTag->attributes($attributes)->content($content)->encode(false)->render();
    }
}
