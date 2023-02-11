<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\A;
use Yiisoft\Html\Tag\I;
use Yiisoft\Html\Tag\P;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

use function implode;
use function in_array;

/**
 * Panel renders a panel component.
 *
 * @see https://bulma.io/documentation/components/panel/
 */
final class Panel extends Widget
{
    public const COLOR_PRIMARY = 'is-primary';
    public const COLOR_LINK = 'is-link';
    public const COLOR_INFO = 'is-info';
    public const COLOR_SUCCESS = 'is-success';
    public const COLOR_WARNING = 'is-warning';
    public const COLOR_DANGER = 'is-danger';
    public const COLOR_DARK = 'is-dark';
    private const COLOR_ALL = [
        self::COLOR_PRIMARY,
        self::COLOR_LINK,
        self::COLOR_INFO,
        self::COLOR_SUCCESS,
        self::COLOR_WARNING,
        self::COLOR_DANGER,
        self::COLOR_DARK,
    ];

    private array $attributes = [];
    private string $autoIdPrefix = 'w';
    private string $blockClass = 'panel-block';
    private string $color = '';
    private ?string $heading = null;
    private array $headingAttributes = [];
    private string $headingClass = 'panel-heading';
    private string $iconClass = 'panel-icon';
    private string $isActiveClass = 'is-active';
    private string $panelClass = 'panel';
    /** @psalm-var array<int, array> */
    private array $tabs = [];
    private array $tabsAttributes = [];
    private string $tabClass = 'panel-tabs';
    /** @psalm-var array<int, string> */
    private array $tabItems = [];
    private string $template = '{panelBegin}{panelHeading}{panelTabs}{panelItems}{panelEnd}';

    /**
     * Returns a new instance with the specified HTML attributes for widget.
     *
     * @param array $values Attribute values indexed by attribute names.
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
     */
    public function autoIdPrefix(string $value): self
    {
        $new = clone $this;
        $new->autoIdPrefix = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified the panel block class.
     *
     * @param string $value The block class.
     */
    public function blockClass(string $value): self
    {
        $new = clone $this;
        $new->blockClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified panel color class.
     *
     * @param string $value The panel color class. Default any color.
     * Possible values are: Panel::COLOR_PRIMARY, Panel::COLOR_INFO, Panel::COLOR_SUCCESS, Panel::COLOR_WARNING,
     * Panel::COLOR_DANGER, Panel::COLOR_DARK
     */
    public function color(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL, true)) {
            $values = implode(' ', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->color = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified the panel class.
     *
     * @param string $value The panel class.
     */
    public function cssClass(string $value): self
    {
        $new = clone $this;
        $new->panelClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified panel heading.
     *
     * @param string $value The panel heading.
     */
    public function heading(string $value): self
    {
        $new = clone $this;
        $new->heading = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified panel heading attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function headingAttributes(array $values): self
    {
        $new = clone $this;
        $new->headingAttributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified the panel heading class.
     *
     * @param string $value The heading class.
     */
    public function headingClass(string $value): self
    {
        $new = clone $this;
        $new->headingClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified the panel icon class.
     *
     * @param string $value The icon class.
     */
    public function iconClass(string $value): self
    {
        $new = clone $this;
        $new->iconClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified ID of the widget.
     *
     * @param string $value The ID of the widget.
     */
    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified active tab class.
     *
     * @param string $value The active tab class.
     */
    public function isActiveClass(string $value): self
    {
        $new = clone $this;
        $new->isActiveClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified panel tabs.
     *
     * @param array $value The panel tabs.
     *
     * @psalm-param array<int, array> $value
     */
    public function tabs(array $value): self
    {
        $new = clone $this;
        $new->tabs = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified the panel tab class.
     *
     * @param string $value The tab class.
     */
    public function tabClass(string $value): self
    {
        $new = clone $this;
        $new->tabClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified panel tabs attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function tabsAttributes(array $values): self
    {
        $new = clone $this;
        $new->tabsAttributes = $values;
        return $new;
    }

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
     */
    public function template(string $value): self
    {
        $new = clone $this;
        $new->template = $value;
        return $new;
    }

    public function render(): string
    {
        $attributes = $this->attributes;

        /** @var string */
        $attributes['id'] ??= (Html::generateId($this->autoIdPrefix) . '-panel');

        $id = $attributes['id'];

        /** @var string */
        $tag = $attributes['tag'] ?? 'nav';

        Html::addCssClass($attributes, $this->panelClass);

        if ($this->color !== '') {
            Html::addCssClass($attributes, $this->color);
        }

        return strtr($this->template, [
            '{panelBegin}' => Html::openTag($tag, $attributes) . PHP_EOL,
            '{panelHeading}' => $this->renderHeading(),
            '{panelTabs}' => $this->renderTabs($id),
            '{panelItems}' => implode('', $this->tabItems),
            '{panelEnd}' => Html::closeTag($tag),
        ]);
    }

    private function renderHeading(): string
    {
        $headingAttributes = $this->headingAttributes;

        if (!empty($this->heading)) {
            Html::addCssClass($headingAttributes, $this->headingClass);

            return P::tag()
                ->attributes($headingAttributes)
                ->content($this->heading)
                ->render() . PHP_EOL;
        }

        return '';
    }

    private function renderTabs(string $id): string
    {
        $tabsAttributes = $this->tabsAttributes;

        if (!empty($this->tabs)) {
            $tabs = '';

            foreach ($this->tabs as $index => $item) {
                $tabs .= $this->renderTab($index, $item, $id . '-' . $index) . PHP_EOL;
            }

            Html::addCssClass($tabsAttributes, $this->tabClass);

            return P::tag()
                ->attributes($tabsAttributes)
                ->content(PHP_EOL . $tabs)
                ->encode(false)
                ->render() . PHP_EOL;
        }

        return '';
    }

    private function renderTab(int $index, array $item, string $id): string
    {
        /** @var string */
        $url = $item['url'] ?? '';

        /** @var string */
        $label = $item['label'] ?? '';

        /** @var bool */
        $encode = $item['encode'] ?? true;

        /** @var array */
        $urlAttributes = $item['urlAttributes'] ?? [];

        /** @var array */
        $tabItems = $item['items'] ?? [];

        if ($url !== '') {
            $urlAttributes['href'] = $url;
        }

        if ($label === '') {
            throw new InvalidArgumentException('The "label" option is required.');
        }

        if ($encode === true) {
            $label = Html::encode($label);
        }

        if ($this->isActive($item)) {
            Html::addCssClass($urlAttributes, $this->isActiveClass);
        }

        if (!empty($tabItems)) {
            /** @var string */
            $urlAttributes['href'] ??= '#' . $id;

            $tabsItems = '';

            /** @psalm-var array[] */
            foreach ($tabItems as $tabItem) {
                $tabsItems .= $this->renderItem($tabItem) . PHP_EOL;
            }

            $this->tabItems[$index] = $tabsItems;
        }

        return A::tag()
            ->attributes($urlAttributes)
            ->content($label)
            ->encode(false)
            ->render();
    }

    private function renderItem(array $item): string
    {
        /** @var array */
        $urlAttributes = $item['urlAttributes'] ?? [];

        /** @var string */
        $label = $item['label'] ?? '';

        /** @var string */
        $icon = $item['icon'] ?? '';

        /** @var bool */
        $encode = $item['encode'] ?? true;

        if ($label === '') {
            throw new InvalidArgumentException('The "label" option is required.');
        }

        /** @var array */
        $labelAttributes = $item['labelAttributes'] ?? [];

        if ($encode) {
            $label = Html::encode($label);
        }

        Html::addCssClass($urlAttributes, $this->blockClass);

        if ($this->isActive($item)) {
            Html::addCssClass($urlAttributes, $this->isActiveClass);
        }

        Html::addCssClass($labelAttributes, $this->iconClass);

        if ($icon !== '') {
            $icon = PHP_EOL . I::tag()
                ->attributes(['aria-hidden' => 'true'])
                ->class($icon) . PHP_EOL;
            $label = PHP_EOL . Span::tag()
                ->attributes($labelAttributes)
                ->content($icon)
                ->encode(false) . PHP_EOL .
                $label . PHP_EOL;
        }

        return A::tag()
            ->attributes($urlAttributes)
            ->content($label)
            ->encode(false)
            ->render();
    }

    /**
     * Checking if active item.
     */
    private function isActive(array $item): bool
    {
        return (bool) ArrayHelper::getValue($item, 'active', false);
    }
}
