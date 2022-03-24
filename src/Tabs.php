<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\I;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

use function array_reverse;
use function implode;
use function in_array;

/**
 * Simple responsive horizontal navigation tabs, with different styles.
 *
 * ```php
 * echo Tabs::widget()
 *     ->alignment(Tabs::ALIGNMENT_CENTERED)
 *     ->size(Tabs::SIZE_LARGE)
 *     ->style(Tabs::STYLE_BOX)
 *     ->items([
 *         [
 *             'label' => 'Pictures',
 *             'icon' => 'fas fa-image',
 *             'active' => true,
 *             'content' => 'Some text about pictures',
 *             'contentAttributes' => [
 *                 'class' => 'is-active',
 *             ],
 *         ],
 *         ['label' => 'Music', 'icon' => 'fas fa-music', 'content' => 'Some text about music'],
 *         ['label' => 'Videos', 'icon' => 'fas fa-film', 'content' => 'Some text about videos'],
 *         ['label' => 'Documents', 'icon' => 'far fa-file-alt', 'content' => 'Some text about documents'],
 *     ]);
 * ```
 *
 * @link https://bulma.io/documentation/components/tabs/
 */
final class Tabs extends Widget
{
    public const ALIGNMENT_CENTERED = 'is-centered';
    public const ALIGNMENT_RIGHT = 'is-right';
    private const ALIGNMENT_ALL = [
        self::ALIGNMENT_CENTERED,
        self::ALIGNMENT_RIGHT,
    ];

    public const SIZE_SMALL = 'is-small';
    public const SIZE_MEDIUM = 'is-medium';
    public const SIZE_LARGE = 'is-large';
    private const SIZE_ALL = [
        self::SIZE_SMALL,
        self::SIZE_MEDIUM,
        self::SIZE_LARGE,
    ];

    public const STYLE_BOX = 'is-boxed';
    public const STYLE_TOGGLE = 'is-toggle';
    public const STYLE_TOGGLE_ROUNDED = 'is-toggle is-toggle-rounded';
    public const STYLE_FULLWIDTH = 'is-fullwidth';
    private const STYLE_ALL = [
        self::STYLE_BOX,
        self::STYLE_TOGGLE,
        self::STYLE_TOGGLE_ROUNDED,
        self::STYLE_FULLWIDTH,
    ];

    private bool $activateItems = true;
    private string $alignment = '';
    private array $attributes = [];
    private string $autoIdPrefix = 'w';
    private ?string $currentPath = null;
    private bool $encode = true;
    private array $items = [];
    private array $itemsAttributes = [];
    private string $size = '';
    private string $style = '';
    private array $tabsContent = [];
    private array $tabsContentAttributes = [];

    /**
     * Returns a new instance with the specified alignment the tabs list.
     *
     * @param string $value The alignment the tabs list. By default, not class is added and the size is considered
     * "is-left". Possible values: Tabs::ALIGNMENT_CENTERED, Tabs::ALIGNMENT_RIGHT.
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function alignment(string $value): self
    {
        if (!in_array($value, self::ALIGNMENT_ALL, true)) {
            $values = implode('", "', self::ALIGNMENT_ALL);
            throw new InvalidArgumentException("Invalid alignment. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->alignment = $value;
        return $new;
    }

    /**
     * The HTML attributes.
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
     */
    public function deactivateItems(): self
    {
        $new = clone $this;
        $new->activateItems = false;
        return $new;
    }

    /**
     * Set encode to true to encode the output.
     *
     * @param bool $value Whether to encode the output.
     *
     * @return self
     */
    public function encode(bool $value): self
    {
        $new = clone $this;
        $new->encode = $value;
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
     * Returns a new instance with the specified items.
     *
     * @param array $value List of tabs items. Each tab item should be an array of the following structure:
     *
     * - `label`: string, required, the nav item label.
     * - `url`: string, optional, the item's URL.
     * - `visible`: bool, optional, whether this menu item is visible.
     * - `urlAttributes`: array, optional, the HTML attributes of the item's link.
     * - `attributes`: array, optional, the HTML attributes of the item container (LI).
     * - `active`: bool, optional, whether the item should be on active state or not.
     * - `encode`: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encode option
     *    for only this item.
     * - `icon`: string, the tab item icon.
     * - `iconAttributes`: array, optional, the HTML attributes of the item's icon.
     * - `rightSide`: bool, position the icon to the right.
     * - `content`: string, required if `items` is not set. The content (HTML) of the tab.
     * - `contentAttributes`: array, array, the HTML attributes of the tab content container.
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
     * Returns a new instance with the specified attributes of the items.
     *
     * @param array $value List of HTML attributes for the items.
     *
     * {@see Html::renderTagAttributes()} For details on how attributes are being rendered.
     *
     * @return self
     */
    public function itemsAttributes(array $value): self
    {
        $new = clone $this;
        $new->itemsAttributes = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified size of the tabs list.
     *
     * @param string $value size class. By default, not class is added and the size is considered "normal".
     * Possible values: Tabs::SIZE_SMALL, Tabs::SIZE_MEDIUM, Tabs::SIZE_LARGE.
     *
     * {@see self::SIZE_ALL}
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function size(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL, true)) {
            $values = implode('", "', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->size = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified style of the tabs list.
     *
     * @param string $value The style of the tabs list. By default, not class is added and the size is considered
     * "normal". Possible values: Tabs::STYLE_BOX, Tabs::STYLE_TOGGLE, Tabs::STYLE_TOGGLE_ROUNDED,
     * Tabs::STYLE_FULLWIDTH.
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function style(string $value): self
    {
        if (!in_array($value, self::STYLE_ALL, true)) {
            $values = implode('", "', self::STYLE_ALL);
            throw new InvalidArgumentException("Invalid alignment. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->style = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified attributes of the tabs content.
     *
     * @param array $value List of HTML attributes for the `tabs-content` container. This will always contain the CSS
     * class `tabs-content`.
     *
     * {@see Html::renderTagAttributes()} For details on how attributes are being rendered.
     *
     * @return self
     */
    public function tabsContentAttributes(array $value): self
    {
        $new = clone $this;
        $new->tabsContentAttributes = $value;
        return $new;
    }

    protected function run(): string
    {
        $attributes = $this->attributes;

        $id = Html::generateId($this->autoIdPrefix) . '-tabs';

        if (array_key_exists('id', $attributes)) {
            /** @var string */
            $id = $attributes['id'];
            unset($attributes['id']);
        }

        Html::addCssClass($attributes, 'tabs');

        if ($this->size !== '') {
            Html::addCssClass($attributes, $this->size);
        }

        if ($this->alignment !== '') {
            Html::addCssClass($attributes, $this->alignment);
        }

        if ($this->style !== '') {
            Html::addCssClass($attributes, $this->style);
        }

        return Div::tag()
            ->attributes($attributes)
            ->content(PHP_EOL . $this->renderItems() . PHP_EOL)
            ->id($id)
            ->encode(false)
            ->render() . $this->renderTabsContent();
    }

    private function renderItems(): string
    {
        $items = $this->items;
        $renderItems = '';

        /**
         * @psalm-var array<
         *  int,
         *  array{
         *    active?: bool,
         *    content?: string,
         *    contentAttributes?: array,
         *    encode?: bool,
         *    icon?: string,
         *    items?: array,
         *    label: string,
         *    url: string,
         *    visible?: bool
         * }> $items
         */
        foreach ($items as $index => $item) {
            if (isset($item['visible']) && $item['visible'] === false) {
                continue;
            }

            $renderItems .= PHP_EOL . $this->renderItem($index, $item);
        }

        return Html::tag('ul', $renderItems . PHP_EOL, $this->itemsAttributes)->encode(false)->render();
    }

    /**
     * @param int $index
     * @param array $item
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    private function renderItem(int $index, array $item): string
    {
        /** @var string */
        $url = $item['url'] ?? '';

        /** @var string */
        $icon = $item['icon'] ?? '';

        /** @var string */
        $label = $item['label'] ?? '';

        /** @var bool */
        $encode = $item['encode'] ?? $this->encode;

        /** @var array */
        $attributes = $item['attributes'] ?? [];

        /** @var array */
        $urlAttributes = $item['urlAttributes'] ?? [];

        /** @var array */
        $iconAttributes = $item['iconAttributes'] ?? [];

        /** @var string|null */
        $content = $item['content'] ?? null;

        /** @var array */
        $contentAttributes = $item['contentAttributes'] ?? [];
        $active = $this->isItemActive($item);

        if ($label === '') {
            throw new InvalidArgumentException("The 'label' option is required.");
        }

        if ($encode === true) {
            $label = Html::encode($label);
        }

        if ($icon !== '') {
            Html::addCssClass($iconAttributes, 'icon is-small');
            $label = $this->renderIcon($label, $icon, $iconAttributes);
        }

        if ($url !== '') {
            $urlAttributes['href'] = $url;
        }

        if ($active) {
            Html::addCssClass($attributes, ['active' => 'is-active']);
        }

        if ($content !== null) {
            if ($url === '') {
                $urlAttributes['href'] = '#' . Html::generateId('l') . '-tabs-c' . $index;
            }

            /** @var string */
            $contentAttributes['id'] ??= Html::generateId($this->autoIdPrefix) . '-tabs-c' . $index;

            $this->tabsContent[] = Div::tag()
                ->attributes($contentAttributes)
                ->content($content)
                ->encode(false)
                ->render();
        }

        return Html::tag(
            'li',
            A::tag()->attributes($urlAttributes)->content($label)->encode(false)->render(),
            $attributes
        )->encode(false)->render();
    }

    /**
     * @param string $label
     * @param string $icon
     * @param array $iconAttributes
     *
     * @return string
     */
    private function renderIcon(string $label, string $icon, array $iconAttributes): string
    {
        /** @var bool */
        $rightSide = $iconAttributes['rightSide'] ?? false;
        unset($iconAttributes['rightSide']);

        $elements = [
            Span::tag()
                ->attributes($iconAttributes)
                ->content(I::tag()->attributes(['class' => $icon, 'aria-hidden' => 'true'])->render())
                ->encode(false)
                ->render(),
            Span::tag()->content($label)->render(),
        ];

        if ($rightSide === true) {
            $elements = array_reverse($elements);
        }

        return implode('', $elements);
    }

    /**
     * Renders tabs content.
     *
     * @return string
     */
    private function renderTabsContent(): string
    {
        $html = '';
        /** @psalm-var string[] */
        $tabsContent = $this->tabsContent;
        $tabsContentAttributes = $this->tabsContentAttributes;

        Html::addCssClass($tabsContentAttributes, 'tabs-content');

        if (!empty($this->tabsContent)) {
            $html .= PHP_EOL . Div::tag()
                ->attributes($tabsContentAttributes)
                ->content(PHP_EOL . implode(PHP_EOL, $tabsContent) . PHP_EOL)
                ->encode(false)
                ->render();
        }

        return $html;
    }

    /**
     * @param array $item
     *
     * @return bool
     */
    private function isItemActive(array $item): bool
    {
        if (isset($item['active'])) {
            return is_bool($item['active']) && $item['active'];
        }

        return $this->activateItems && isset($item['url']) && $item['url'] === $this->currentPath;
    }
}
