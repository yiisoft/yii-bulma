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
    private const COLORS = ['is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger', 'is-dark'];
    private const SIZES = ['is-small', 'is-medium', 'is-large'];
    private array $attributes = [];
    private string $autoIdPrefix = 'w';
    private array $closeButtonAttributes = [];
    private string $closeButtonClass = 'modal-close';
    private string $closeButtonSize = '';
    private array $contentAttributes = [];
    private string $modalBackgroundClass = 'modal-background';
    private string $modalButtonClass = 'button modal-button';
    private string $modalClass = 'modal';
    private string $modalContentClass = 'modal-content';
    private array $toggleButtonAttributes = [];
    private string $toggleButtonLabel = 'Toggle button';
    private string $toggleButtonSize = '';
    private string $toggleButtonColor = '';
    private bool $withoutCloseButton = true;
    private bool $withoutToggleButton = true;

    /**
     * The HTML attributes. The following special options are recognized.
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
     * @param string $value The close button size.
     *
     * @return self
     */
    public function closeButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZES, true)) {
            $values = implode('"', self::SIZES);
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
    public function modalBackgroundClass(string $value): self
    {
        $new = clone $this;
        $new->modalBackgroundClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal button class.
     *
     * @param string $value The modal button class.
     *
     * @return self
     */
    public function modalButtonClass(string $value): self
    {
        $new = clone $this;
        $new->modalButtonClass = $value;

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
    public function modalContentClass(string $value): self
    {
        $new = clone $this;
        $new->modalContentClass = $value;

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
     * @param string $value The toggle button color.
     *
     * @return self
     */
    public function toggleButtonColor(string $value): self
    {
        if (!in_array($value, self::COLORS, true)) {
            $values = implode(' ', self::COLORS);
            throw new InvalidArgumentException("Invalid color. Valid values are: $values.");
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
     * @param string $value The toggle button size.
     *
     * @return self
     */
    public function toggleButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZES, true)) {
            $values = implode(' ', self::SIZES);
            throw new InvalidArgumentException("Invalid size. Valid values are: $values.");
        }

        $new = clone $this;
        $new->toggleButtonSize = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified options for rendering the close button tag.
     *
     * @return self
     */
    public function withoutCloseButton(): self
    {
        $new = clone $this;
        $new->withoutCloseButton = false;

        return $new;
    }

    /**
     * Returns a new instance with the disabled toggle button.
     *
     * @return self
     */
    public function withoutToggleButton(): self
    {
        $new = clone $this;
        $new->withoutToggleButton = false;

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
        Html::addCssClass($contentAttributes, $this->modalContentClass);

        if ($this->withoutToggleButton) {
            $html .= $this->renderToggleButton($id) . "\n";
        }

        $html .= Html::openTag('div', $attributes) . "\n"; // .modal
        $html .= Div::tag()->class($this->modalBackgroundClass) . "\n";

        if ($this->withoutCloseButton) {
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

        Html::addCssClass($toggleButtonAttributes, $this->modalButtonClass);

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
