<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function array_reverse;
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
 *         ['label' => 'Pictures', 'icon' => 'fas fa-image', 'active' => true, 'content' => 'Some text about pictures'],
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
    public const SIZE_SMALL = 'is-small';
    public const SIZE_MEDIUM = 'is-medium';
    public const SIZE_LARGE = 'is-large';
    private const SIZE_ALL = [
        self::SIZE_SMALL,
        self::SIZE_MEDIUM,
        self::SIZE_LARGE,
    ];

    public const ALIGNMENT_CENTERED = 'is-centered';
    public const ALIGNMENT_RIGHT = 'is-right';
    private const ALIGNMENT_ALL = [
        self::ALIGNMENT_CENTERED,
        self::ALIGNMENT_RIGHT,
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

    private array $options = [];
    private array $items = [];
    private ?string $currentPath = null;
    private bool $activateItems = true;
    private bool $encodeLabels = true;
    private string $size = '';
    private string $alignment = '';
    private string $style = '';
    private array $tabsContent = [];
    private array $tabsContentOptions = [];
    private bool $renderTabsContent = true;

    private function buildOptions(): void
    {
        Html::addCssClass($this->options, 'tabs');
        Html::addCssClass($this->tabsContentOptions, 'tabs-content');

        $this->options['id'] ??= $this->getId();

        if ($this->size !== '') {
            Html::addCssClass($this->options, $this->size);
        }

        if ($this->alignment !== '') {
            Html::addCssClass($this->options, $this->alignment);
        }

        if ($this->style !== '') {
            Html::addCssClass($this->options, $this->style);
        }
    }

    /**
     * @throws \JsonException
     *
     * @return string
     */
    protected function run(): string
    {
        $this->buildOptions();

        $html = Html::tag('div', "\n" . $this->renderItems() . "\n", $this->options);

        if ($this->renderTabsContent) {
            $html .= "\n" . Html::tag('div', "\n" . implode("\n", $this->tabsContent) . "\n", $this->tabsContentOptions);
        }

        return $html;
    }

    /**
     * @param array $value
     *
     * @return self
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;

        return $new;
    }

    /**
     * List of tabs items.
     *
     * Each tab item should be an array of the following structure:
     *
     * - `label`: string, required, the nav item label.
     * - `url`: string, optional, the item's URL.
     * - `visible`: bool, optional, whether this menu item is visible.
     * - `linkOptions`: array, optional, the HTML attributes of the item's link.
     * - `options`: array, optional, the HTML attributes of the item container (LI).
     * - `active`: bool, optional, whether the item should be on active state or not.
     * - `encode`: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for only this item.
     * - `icon`: string, the tab item icon.
     * - `iconOptions`: array, optional, the HTML attributes of the item's icon.
     *     - `rightSide`: bool, position the icon to the right.
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
     * @param bool $value Whether to automatically activate item its route matches the currently requested route.
     *
     * @return self
     */
    public function activateItems(bool $value): self
    {
        $new = clone $this;
        $new->activateItems = $value;

        return $new;
    }

    /**
     * @param bool $value Whether the labels for menu items should be HTML-encoded.
     *
     * @return self
     */
    public function encodeLabels(bool $value): self
    {
        $new = clone $this;
        $new->encodeLabels = $value;

        return $new;
    }

    /**
     * @param string|null $value Allows you to assign the current path of the URL from request controller.
     *
     * @return self
     */
    public function currentPath(?string $value): self
    {
        $new = clone $this;
        $new->currentPath = $value;

        return $new;
    }

    /**
     * @throws \JsonException
     *
     * @return string
     */
    private function renderItems(): string
    {
        $items = '';
        foreach ($this->items as $index => $item) {
            if (isset($item['visible']) && $item['visible'] === false) {
                continue;
            }
            $items .= "\n" . $this->renderItem($index, $item);
        }

        return Html::tag('ul', $items . "\n");
    }

    /**
     * @param int $index
     * @param array $item
     *
     * @throws InvalidArgumentException|\JsonException
     *
     * @return string
     */
    private function renderItem(int $index, array $item): string
    {
        $url = ArrayHelper::getValue($item, 'url', '');
        $icon = ArrayHelper::getValue($item, 'icon', '');
        $label = ArrayHelper::getValue($item, 'label', '');
        $encode = ArrayHelper::getValue($item, 'encode', $this->encodeLabels);
        $options = ArrayHelper::getValue($item, 'options', []);
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $iconOptions = ArrayHelper::getValue($item, 'iconOptions', []);
        $content = ArrayHelper::getValue($item, 'content');
        $contentOptions = ArrayHelper::getValue($item, 'contentOptions', []);
        $id = ArrayHelper::getValue($contentOptions, 'id', $this->getId() . '-c' . $index);

        if ($label === '') {
            throw new InvalidArgumentException("The 'label' option is required.");
        }

        if ($encode === true) {
            $label = Html::encode($label);
        }

        if ($icon !== '') {
            Html::addCssClass($iconOptions, 'icon is-small');
            $label = $this->renderIcon($label, $icon, $iconOptions);
        }

        if ($this->isItemActive($item)) {
            Html::addCssClass($options, 'is-active');
        } else {
            Html::addCssClass($contentOptions, 'is-hidden');
        }

        if ($url !== '') {
            $linkOptions['href'] = $url;
        } elseif ($this->renderTabsContent) {
            $linkOptions['href'] = '#' . $id;
        }
        
        if ($this->renderTabsContent) {
            $contentOptions['id'] = $id;
            $this->tabsContent[] = Html::tag('div', $content, $contentOptions);
        }

        return Html::tag('li', Html::tag('a', $label, $linkOptions), $options);
    }

    /**
     * @param array $item
     *
     * @return bool
     */
    private function isItemActive(array $item): bool
    {
        if (isset($item['active'])) {
            return (bool)ArrayHelper::getValue($item, 'active');
        }

        return
            $this->activateItems
            && isset($item['url'])
            && $item['url'] === $this->currentPath;
    }

    /**
     * @param string $value Size of the tabs list.
     *
     * @see self::SIZE_ALL
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
     * @param string $value Alignment the tabs list.
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
     * @param string $value Style of the tabs list.
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
     * @param string $label
     * @param string $icon
     * @param array $iconOptions
     *
     * @throws \JsonException
     *
     * @return string
     */
    private function renderIcon(string $label, string $icon, array $iconOptions): string
    {
        $rightSide = ArrayHelper::getValue($iconOptions, 'rightSide', false);
        unset($iconOptions['rightSide']);

        $elements = [
            Html::tag('span', Html::tag('i', '', ['class' => $icon, 'aria-hidden' => 'true']), $iconOptions),
            Html::tag('span', $label),
        ];

        if ($rightSide === true) {
            $elements = array_reverse($elements);
        }

        return implode('', $elements);
    }

    /**
     * Returns the Id of the widget.
     *
     * @return string|null Id of the widget.
     */
    protected function getId(): ?string
    {
        return parent::getId() . '-tabs';
    }

    /**
     * Whether to render the `tabs-content` container and its content. You may set this property to be false so that you
     * can manually render `tabs-content` yourself in case your tab contents are complex.
     *
     * @param bool $value
     *
     * @return self
     */
    public function renderTabsContent(bool $value): self
    {
        $new = clone $this;
        $new->renderTabsContent = $value;

        return $new;
    }

    /**
     * List of HTML attributes for the `tabs-content` container. This will always contain the CSS class `tabs-content`.
     *
     * @param array $value
     *
     * @return self
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function tabsContentOptions(array $value): self
    {
        $new = clone $this;
        $new->tabsContentOptions = $value;

        return $new;
    }
}
