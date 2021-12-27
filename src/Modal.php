<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Widget\Widget;

use function implode;
use function in_array;

/**
 * Modal renders a modal window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the {@see Widget::begin()} and {@see Widget::end()}
 * calls within the modal window:
 *
 * ```php
 * echo Modal::widget()->begin();
 *
 * echo 'Say hello...';
 *
 * echo Modal::end();
 * ```
 *
 * @link https://bulma.io/documentation/components/modal/
 */
final class Modal extends Widget
{
    public const SIZE_SMALL = 'is-small';
    public const SIZE_MEDIUM = 'is-medium';
    public const SIZE_LARGE = 'is-large';
    private const SIZE_ALL = [
        self::SIZE_SMALL,
        self::SIZE_MEDIUM,
        self::SIZE_LARGE,
    ];

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
    private string $backgroundClass = 'modal-background';
    private string $buttonClass = 'button modal-button';
    private array $closeButtonAttributes = [];
    private string $closeButtonClass = 'modal-close';
    private string $closeButtonSize = '';
    private array $contentAttributes = [];
    private string $contentClass = 'modal-content';
    private string $modalClass = 'modal';
    private array $toggleButtonAttributes = [];
    private string $toggleButtonLabel = 'Toggle button';
    private string $toggleButtonSize = '';
    private string $toggleButtonColor = '';
    private bool $withoutCloseButton = false;
    private bool $withoutToggleButton = false;

    /**
     * The HTML attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * See {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
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
     * Returns a new instance with the specified close button options.
     *
     * @param array $value The close button options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function closeButtonAttributes(array $value): self
    {
        $new = clone $this;
        $new->closeButtonAttributes = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified close button size.
     *
     * @param string $value The close button size. Default setting empty normal.
     * Possible values: Modal::SIZE_SMALL, Modal::SIZE_MEDIUM, Model::SIZE_LARGE.
     *
     * @return self
     */
    public function closeButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL, true)) {
            $values = implode('"', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->closeButtonSize = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified content options.
     *
     * @param array $value The content options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function contentAttributes(array $value): self
    {
        $new = clone $this;
        $new->contentAttributes = $value;

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
     * Returns a new instance with the specified modal background class.
     *
     * @param string $value The modal background class.
     *
     * @return self
     */
    public function backgroundClass(string $value): self
    {
        $new = clone $this;
        $new->backgroundClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal button class.
     *
     * @param string $value The modal button class.
     *
     * @return self
     */
    public function buttonClass(string $value): self
    {
        $new = clone $this;
        $new->buttonClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal class.
     *
     * @param string $value The modal class.
     *
     * @return self
     */
    public function modalClass(string $value): self
    {
        $new = clone $this;
        $new->modalClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal content class.
     *
     * @param string $value The modal content class.
     *
     * @return self
     */
    public function contentClass(string $value): self
    {
        $new = clone $this;
        $new->contentClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified toggle button options.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function toggleButtonAttributes(array $values): self
    {
        $new = clone $this;
        $new->toggleButtonAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the specified toggle button color.
     *
     * @param string $value The toggle button color. Default setting is empty without color.
     * Possible values: Modal::COLOR_PRIMARY, Modal::COLOR_LINK, Modal::COLOR_INFO, Modal::COLOR_SUCCESS,
     * Modal::COLOR_WARNING, Modal::COLOR_DANGER, Modal::COLOR_DARK.
     *
     * @return self
     */
    public function toggleButtonColor(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL, true)) {
            $values = implode(' ', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->toggleButtonColor = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified toggle button label.
     *
     * @param string $value The toggle button label.
     *
     * @return self
     */
    public function toggleButtonLabel(string $value): self
    {
        $new = clone $this;
        $new->toggleButtonLabel = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified toggle button size.
     *
     * @param string $value The toggle button size. Default setting empty normal.
     * Possible values: Modal::SIZE_SMALL, Modal::SIZE_MEDIUM, Model::SIZE_LARGE.
     *
     * @return self
     */
    public function toggleButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL, true)) {
            $values = implode(' ', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->toggleButtonSize = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified options for rendering the close button tag.
     *
     * @param bool $value Whether the close button is disabled.
     *
     * @return self
     */
    public function withoutCloseButton(bool $value): self
    {
        $new = clone $this;
        $new->withoutCloseButton = $value;

        return $new;
    }

    /**
     * Returns a new instance with the disabled toggle button.
     *
     * @param bool $value Whether the toggle button is disabled.
     *
     * @return self
     */
    public function withoutToggleButton(bool $value): self
    {
        $new = clone $this;
        $new->withoutToggleButton = $value;

        return $new;
    }

    public function begin(): ?string
    {
        parent::begin();

        $attributes = $this->attributes;
        $contentAttributes = $this->contentAttributes;
        $html = '';

        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = Html::generateId($this->autoIdPrefix) . '-modal';
        }

        /** @var string */
        $id = $attributes['id'];

        Html::addCssClass($attributes, $this->modalClass);
        Html::addCssClass($contentAttributes, $this->contentClass);

        if ($this->withoutToggleButton == false) {
            $html .= $this->renderToggleButton($id) . "\n";
        }

        $html .= Html::openTag('div', $attributes) . "\n"; // .modal
        $html .= Div::tag()->class($this->backgroundClass) . "\n";

        if ($this->withoutCloseButton === false) {
            $html .= $this->renderCloseButton() . "\n";
        }

        $html .= Html::openTag('div', $contentAttributes) . "\n"; // .modal-content

        return $html;
    }

    protected function run(): string
    {
        $html = Html::closeTag('div') . "\n"; // .modal-content
        $html .= Html::closeTag('div'); // .modal

        return $html;
    }

    /**
     * Renders the toggle button.
     *
     * @param string $id
     *
     * @return string
     */
    private function renderToggleButton(string $id): string
    {
        $toggleButtonAttributes = $this->toggleButtonAttributes;

        $toggleButtonAttributes['data-target'] = '#' . $id;
        $toggleButtonAttributes['aria-haspopup'] = 'true';

        if ($this->toggleButtonSize !== '') {
            Html::addCssClass($toggleButtonAttributes, $this->toggleButtonSize);
        }

        if ($this->toggleButtonColor !== '') {
            Html::addCssClass($toggleButtonAttributes, $this->toggleButtonColor);
        }

        Html::addCssClass($toggleButtonAttributes, $this->buttonClass);

        return Button::tag()->attributes($toggleButtonAttributes)->content($this->toggleButtonLabel)->render();
    }

    /**
     * Renders the close button.
     *
     * @return string
     */
    private function renderCloseButton(): string
    {
        $closeButtonAttributes = $this->closeButtonAttributes;
        $closeButtonAttributes['aria-label'] = 'close';

        if ($this->closeButtonSize !== '') {
            Html::addCssClass($closeButtonAttributes, $this->closeButtonSize);
        }

        Html::addCssClass($closeButtonAttributes, $this->closeButtonClass);

        return Button::tag()->attributes($closeButtonAttributes)->render();
    }
}
