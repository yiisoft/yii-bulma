<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

use function implode;
use function in_array;

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
    private string $template = '{panelBegin}{panelHeading}{panelTabs}{panelItems}{panelEnd}';
    private array $tabItems = [];

    /**
     * Returns a new instance with the specified template.
     *
     * @param string $value The string the template for rendering panel:
     *
     * - `{panelBegin}`: _string_, which will render the panel container begin.
     * - `{panelHeading}`: _string_, which will render the panel heading.
     * - `{panelTabs}`: _string_, which will render the panel tabs.
     * - `{panelItems}`: _string_, which will render the panel items.
     * - `{panelEnd}`: _string_, which will render the panel container end.
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
     * Returns a new instance with the specified options.
     *
     * @param array $value The HTML attributes for the panel's container tag.
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
     * Returns a new instance with the specified panel heading.
     *
     * @param string $value The panel heading.
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
     * Returns a new instance with the specified panel heading options.
     *
     * @param array $value The panel heading options.
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
     * Returns a new instance with the specified panel color class.
     *
     * @param string $value The panel color class.
     *
     * @return self
     */
    public function color(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL, true)) {
            $values = implode('", "', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->color = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified panel tabs.
     *
     * @param array $value The panel tabs.
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
     * Returns a new instance with the specified panel tabs options.
     *
     * @param array $value The panel tabs options.
     *
     * @return self
     */
    public function tabsOptions(array $value): self
    {
        $new = clone $this;
        $new->tabsOptions = $value;

        return $new;
    }

    protected function run(): string
    {
        $this->buildOptions();

        $tag = ArrayHelper::getValue($this->options, 'tag', 'nav');

        return strtr($this->template, [
            '{panelBegin}' => Html::openTag($tag, $this->options),
            '{panelHeading}' => $this->renderHeading(),
            '{panelTabs}' => $this->renderTabs(),
            '{panelItems}' => implode("\n", $this->tabItems),
            '{panelEnd}' => Html::closeTag($tag),
        ]);
    }

    /**
     * @throws JsonException
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
     * @throws JsonException
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

            return "\n" . Html::tag('p', "\n" . $tabs, $this->tabsOptions)->encode(false) . "\n";
        }

        return '';
    }

    private function buildOptions(): void
    {
        Html::addCssClass($this->options, 'panel');

        $this->options['id'] ??= $this->getId() . '-panel';

        if ($this->color !== '') {
            Html::addCssClass($this->options, $this->color);
        }
    }

    /**
     * @param int $index
     * @param array $item
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderTab(int $index, array $item): string
    {
        $id = $this->getId() . '-panel-c' . $index;
        $url = ArrayHelper::getValue($item, 'url', '');
        $label = ArrayHelper::getValue($item, 'label', '');
        $encode = ArrayHelper::getValue($item, 'encode', true);
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
        $tabItems = ArrayHelper::getValue($item, 'items', []);
        $tabItemsContainerOptions = ArrayHelper::getValue($item, 'itemsContainerOptions', []);

        if ($url !== '') {
            $linkOptions['href'] = $url;
        }

        if ($label === '') {
            throw new InvalidArgumentException('The "label" option is required.');
        }

        if ($encode === true) {
            $label = Html::encode($label);
        }

        if ($this->isActive($item)) {
            Html::addCssClass($linkOptions, ['active' => 'is-active']);
        }

        if (is_array($tabItems) && !empty($tabItems)) {
            $linkOptions['href'] ??= '#' . $id;
            $tabItemsContainerOptions['id'] ??= $id;

            $tabItemsContainer = Html::openTag('div', $tabItemsContainerOptions) . "\n";

            foreach ($tabItems as $tabItem) {
                $tabItemsContainer .= $this->renderItem($tabItem) . "\n";
            }

            $tabItemsContainer .= Html::closeTag('div');

            $this->tabItems[$index] = $tabItemsContainer;
        }

        return Html::tag('a', $label, $linkOptions)->render();
    }

    private function renderItem(array $item): string
    {
        $options = ArrayHelper::getValue($item, 'options', []);
        $label = ArrayHelper::getValue($item, 'label', '');
        $icon = ArrayHelper::getValue($item, 'icon', '');
        $encode = ArrayHelper::getValue($item, 'encode', true);

        if ($label === '') {
            throw new InvalidArgumentException('The "label" option is required.');
        }

        if ($encode === true) {
            $label = Html::encode($label);
        }

        Html::addCssClass($options, 'panel-block');

        if ($this->isActive($item)) {
            Html::addCssClass($options, ['active' => 'is-active']);
        }

        $labelOptions = ['class' => 'panel-icon'];

        if ($icon !== '') {
            $icon = "\n" . Html::tag('i', '', ['class' => $icon, 'aria-hidden' => 'true']) . "\n";
            $label = "\n" . Html::tag('span', $icon, $labelOptions)->encode(false) . "\n" . $label . "\n";
        }

        return Html::tag('a', $label, $options)->encode(false)->render();
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
        return (bool) ArrayHelper::getValue($item, 'active', false);
    }
}
