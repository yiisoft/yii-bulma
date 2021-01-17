<?php

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

final class Panel extends Widget
{
    public const COLOR_PRIMARY = 'is-primary';
    public const COLOR_LINK = 'is-link';
    public const COLOR_INFO = 'is-info';
    public const COLOR_SUCCESS = 'is-success';
    public const COLOR_WARNING = 'is-warning';
    public const COLOR_DANGER = 'is-danger';
    private const COLOR_ALL = [
        self::COLOR_PRIMARY,
        self::COLOR_LINK,
        self::COLOR_INFO,
        self::COLOR_SUCCESS,
        self::COLOR_WARNING,
        self::COLOR_DANGER,
    ];

    private array $options = [];
    private array $headingOptions = [];
    private ?string $heading = null;
    private string $color = '';
    private array $tabs = [];
    private array $tabsOptions = [];
    private bool $encodeLabels = true;
    private string $template = '{panelBegin}{panelHeading}{panelTabs}{panelItems}{panelEnd}';
    private array $items = [];

    protected function run(): string
    {
        $this->buildOptions();

        return strtr($this->template, [
            '{panelBegin}' => Html::beginTag('nav', $this->options),
            '{panelHeading}' => $this->renderHeading(),
            '{panelTabs}' => $this->renderTabs(),
            '{panelItems}' => implode("\n", $this->items),
            '{panelEnd}' => Html::endTag('nav'),
        ]);
    }

    private function buildOptions(): void
    {
        Html::addCssClass($this->options, 'panel');

        $this->options['id'] ??= "{$this->getId()}-panel";

        if ($this->color !== '') {
            Html::addCssClass($this->options, $this->color);
        }
    }

    /**
     * String the template for rendering panel.
     *
     * - `{panelBegin}`: _string_, which will render the panel container begin.
     * - `{panelHeading}`: _string_, which will render the panel heading.
     * - `{panelTabs}`: _string_, which will render the panel tabs.
     * - `{panelItems}`: _string_, which will render the panel items.
     * - `{panelEnd}`: _string_, which will render the panel container end.
     *
     * @param string $value
     *
     * @return self
     */
    public function template(string $value): self
    {
        $new = clone $this;
        $new->template = $value;

        return $new;
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
     * @param string $value
     *
     * @return self
     */
    public function heading(string $value): self
    {
        $new = clone $this;
        $new->heading = $value;

        return $new;
    }

    /**
     * @param array $value
     *
     * @return self
     */
    public function headingOptions(array $value): self
    {
        $new = clone $this;
        $new->headingOptions = $value;

        return $new;
    }

    /**
     * Set progress bar color.
     *
     * @var string $value Color class.
     *
     * @return self
     */
    public function color(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL)) {
            $values = implode('", "', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->color = $value;

        return $new;
    }

    /**
     * @param array $value
     *
     * @return self
     */
    public function tabs(array $value): self
    {
        $new = clone $this;
        $new->tabs = $value;

        return $new;
    }

    /**
     * @param array $value
     *
     * @return self
     */
    public function tabsOptions(array $value): self
    {
        $new = clone $this;
        $new->tabsOptions = $value;

        return $new;
    }

    /**
     * @throws \JsonException
     *
     * @return string
     */
    private function renderHeading(): string
    {
        if ($this->heading !== null) {
            Html::addCssClass($this->headingOptions, 'panel-heading');
            return "\n" . Html::tag('p', $this->heading, $this->headingOptions) . "\n";
        }

        return '';
    }

    /**
     * @throws \JsonException
     *
     * @return string
     */
    private function renderTabs(): string
    {
        if (!empty($this->tabs)) {
            $tabs = '';
            foreach ($this->tabs as $index => $item) {
                $tabs .= $this->renderTab($index, $item) . "\n";
            }

            Html::addCssClass($this->tabsOptions, 'panel-tabs');

            return "\n" . Html::tag('p', "\n" . $tabs, $this->tabsOptions) . "\n";
        }

        return '';
    }

    /**
     * @param int $index
     * @param array $item
     *
     * @throws \JsonException
     *
     * @return string
     */
    private function renderTab(int $index, array $item): string
    {
        $label = ArrayHelper::getValue($item, 'label', '');
        $encode = ArrayHelper::getValue($item, 'encode', $this->encodeLabels);
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $items = ArrayHelper::getValue($item, 'items', []);

        $linkOptions['id'] = ArrayHelper::getValue($item, 'id', $this->options['id'] . '-tab-' . $index);

        if ($label === '') {
            throw new InvalidArgumentException("The 'label' option is required.");
        }

        if ($encode === true) {
            $label = Html::encode($label);
        }

        if ($this->isActive($item)) {
            Html::addCssClass($linkOptions, 'is-active');
        }

        if (is_array($items) && !empty($items)) {
            foreach ($items as $item) {
                $this->items[$index] = $this->renderItem($index, $item);
            }
        }

        return Html::tag('a', $label, $linkOptions);
    }

    private function renderItem(int $index, array $item): string
    {
        $options = (array)ArrayHelper::getValue($item, 'options', []);
        $label = (string)ArrayHelper::getValue($item, 'label', '');
        $icon = (string)ArrayHelper::getValue($item, 'icon', '');

        Html::addCssClass($options, 'panel-block');

        if ($this->isActive($item)) {
            Html::addCssClass($options, 'is-active');
        }

        if ($icon !== '') {
            $icon = "\n". Html::tag('i', '', ['class' => $icon, 'aria-hidden' => 'true']) . "\n";
            $label = "\n" . Html::tag('span', $icon, ['class' => 'panel-icon']) . "\n" . $label . "\n";
        }

        return Html::tag('a', $label, $options) . "\n";
    }

    /**
     * Checking if active item.
     *
     * @param array $item
     *
     * @return bool
     */
    private function isActive(array $item): bool
    {
        return (bool)ArrayHelper::getValue($item, 'active', false);
    }
}
