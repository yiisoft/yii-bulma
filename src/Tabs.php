<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

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

    private function buildOptions(): void
    {
        $this->options['id'] ??= "{$this->getId()}-tabs";
        $this->options = $this->addOptions($this->options, 'tabs');

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

        return Html::tag('div', "\n" . $this->renderItems() . "\n", $this->options);
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
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL.
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: bool, optional, whether the item should be on active state or not.
     * - encode: bool, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for only this item.
     * - icon: string, the nav item icon.
     * - iconOptions: array, optional, the HTML attributes of the item's icon.
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

    public function activateItems(bool $value): self
    {
        $new = clone $this;
        $new->activateItems = $value;

        return $new;
    }

    public function encodeLabels(bool $value): self
    {
        $new = clone $this;
        $new->encodeLabels = $value;

        return $new;
    }

    /**
     * @param string|null $value allows you to assign the current path of the url from request controller.
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
     * @throws \JsonException|InvalidArgumentException
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

        $options['id'] = ArrayHelper::getValue($item, 'id', $this->options['id'] . '-' . $index);

        if ($label === '') {
            throw new InvalidArgumentException("The 'label' option is required.");
        }

        if ($encode === true) {
            $label = Html::encode($label);
        }

        if ($icon !== '') {
            $iconOptions = $this->addOptions($iconOptions, 'icon is-small');
            $label = $this->renderIcon($label, $icon, $iconOptions);
        }

        if ($this->isItemActive($item)) {
            Html::addCssClass($options, 'is-active');
        }

        if ($url !== '') {
            $linkOptions['href'] = $url;
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

        if (
            $this->activateItems
            && isset($item['url'])
            && $item['url'] === $this->currentPath
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param string $value
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function size(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL)) {
            $values = implode('", "', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->size = $value;

        return $new;
    }

    /**
     * @param string $value
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function alignment(string $value): self
    {
        if (!in_array($value, self::ALIGNMENT_ALL)) {
            $values = implode('", "', self::ALIGNMENT_ALL);
            throw new InvalidArgumentException("Invalid alignment. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->alignment = $value;

        return $new;
    }

    /**
     * @param string $value
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function style(string $value): self
    {
        if (!in_array($value, self::STYLE_ALL)) {
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
        return
            Html::tag('span', Html::tag('i', '', ['class' => $icon, 'aria-hidden' => 'true']), $iconOptions) .
            Html::tag('span', $label);
    }
}