<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\P;
use Yiisoft\Widget\Widget;

use function implode;
use function in_array;

/**
 * ModalCard renders a modal window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the {@see Widget::begin()} and {@see Widget::end()}
 * calls within the modal window:
 *
 * ```php
 * echo ModalCard::widget()
 *     ->title('Modal title')
 *     ->footer(
 *         Html::button('Cancel', ['class' => 'button'])
 *     )
 *     ->begin();
 *
 * echo 'Say hello...';
 *
 * echo ModalCard::end();
 * ```
 *
 * @link https://bulma.io/documentation/components/modal/
 */
final class ModalCard extends Widget
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
    private array $bodyAttributes = [];
    private string $bodyClass = 'modal-card-body';
    private string $buttonClass = 'button modal-button';
    private array $cardAttributes = [];
    private array $closeButtonAttributes = [];
    private string $closeButtonClass = 'button delete';
    private string $closeButtonSize = '';
    private string $contentClass = 'modal-card';
    private string $footer = '';
    private array $headerAttributes = [];
    private array $footerAttributes = [];
    private string $footClass = 'modal-card-foot';
    private string $headClass = 'modal-card-head';
    private string $modalCardClass = 'modal';
    private string $title = '';
    private string $titleClass = 'modal-card-title';
    private array $titleAttributes = [];
    private array $toggleButtonAttributes = [];
    private string $toggleButtonColor = '';
    private string $toggleButtonLabel = 'Toggle button';
    private string $toggleButtonSize = '';
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
     * Returns a new instance with the specified body attributes.
     *
     * @param array $value The body attributes.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function bodyAttributes(array $value): self
    {
        $new = clone $this;
        $new->bodyAttributes = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified close button attributes.
     *
     * @param array $value The close button attributes.
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
     * Returns a new instance with the specified close button class.
     *
     * @param string $value The close button class.
     *
     * @return self
     */
    public function closeButtonClass(string $value): self
    {
        $new = clone $this;
        $new->closeButtonClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified close button size.
     *
     * @param string $value The close button size. Default setting empty normal.
     * Possible values are: ModalCard::SIZE_SMALL, ModalCard::SIZE_MEDIUM, ModalCard::SIZE_LARGE.
     *
     * @return self
     */
    public function closeButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL, true)) {
            $values = implode(' ', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->closeButtonSize = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified card attributes.
     *
     * @param array $value The content attributes.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function cardAttributes(array $value): self
    {
        $new = clone $this;
        $new->cardAttributes = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified footer content.
     *
     * @param string $value The footer content in the modal window.
     *
     * @return self
     */
    public function footer(string $value): self
    {
        $new = clone $this;
        $new->footer = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified footer attributes.
     *
     * @param array $value The footer attributes.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function footerAttributes(array $value): self
    {
        $new = clone $this;
        $new->footerAttributes = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified header attributes.
     *
     * @param array $value The header attributes.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function headerAttributes(array $value): self
    {
        $new = clone $this;
        $new->headerAttributes = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified ID of the widget.
     *
     * @param string|null $value The ID of the widget.
     *
     * @return self
     */
    public function id(?string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified modal card background class.
     *
     * @param string $value The modal card background class.
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
     * Returns a new instance with the specified modal card body class.
     *
     * @param string $value The modal card body class.
     *
     * @return self
     */
    public function bodyClass(string $value): self
    {
        $new = clone $this;
        $new->bodyClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal card button class.
     *
     * @param string $value The modal card button class.
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
     * Returns a new instance with the specified modal card class.
     *
     * @param string $value The modal card class.
     *
     * @return self
     */
    public function modalCardClass(string $value): self
    {
        $new = clone $this;
        $new->modalCardClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal card content class.
     *
     * @param string $value The modal card content class.
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
     * Returns a new instance with the specified modal card footer class.
     *
     * @param string $value The modal card footer class.
     *
     * @return self
     */
    public function footClass(string $value): self
    {
        $new = clone $this;
        $new->footClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal card head class.
     *
     * @param string $value The modal card head class.
     *
     * @return self
     */
    public function headClass(string $value): self
    {
        $new = clone $this;
        $new->headClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified modal card title class.
     *
     * @param string $value The modal card title class.
     *
     * @return self
     */
    public function titleClass(string $value): self
    {
        $new = clone $this;
        $new->titleClass = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified title content.
     *
     * @param string $value The title content in the modal window.
     *
     * @return self
     */
    public function title(string $value): self
    {
        $new = clone $this;
        $new->title = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified title attributes.
     *
     * @param array $value The title attributes.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function titleAttributes(array $value): self
    {
        $new = clone $this;
        $new->titleAttributes = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified toggle button attributes.
     *
     * @param array $value The toggle button attributes.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function toggleButtonAttributes(array $value): self
    {
        $new = clone $this;
        $new->toggleButtonAttributes = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified toggle button color.
     *
     * @param string $value The toggle button color. Default seeting emtpy without any color.
     * Possible values are: ModalCard::COLOR_PRIMARY, ModalCard::COLOR_INFO, ModalCard::COLOR_SUCCESS,
     * ModalCard::COLOR_WARNING, ModalCard::COLOR_DANGER, ModalCard::COLOR_DARK
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
     * Returns a new instance with the specified ID of the toggle button.
     *
     * @param string|null $value The ID of the widget.
     *
     * @return self
     */
    public function toggleButtonId(?string $value): self
    {
        $new = clone $this;
        $new->toggleButtonAttributes['id'] = $value;
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
        if (!in_array($value, self::SIZE_ALL, true)) {
            $values = implode('', self::SIZE_ALL);
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
        $cardAttributes = $this->cardAttributes;
        $html = '';

        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = Html::generateId($this->autoIdPrefix) . '-modal';
        }

        /** @var string */
        $id = $attributes['id'];

        if ($this->withoutToggleButton === false) {
            $html .= $this->renderToggleButton($id) . "\n";
        }

        Html::addCssClass($attributes, $this->modalCardClass);
        Html::addCssClass($cardAttributes, $this->contentClass);

        $html .= Html::openTag('div', $attributes) . "\n"; // .modal
        $html .= $this->renderBackgroundTransparentOverlay() . "\n"; // .modal-background
        $html .= Html::openTag('div', $cardAttributes) . "\n"; // .modal-card
        $html .= $this->renderHeader();
        $html .= $this->renderBodyBegin() . "\n";

        return $html;
    }

    protected function run(): string
    {
        $html = $this->renderBodyEnd() . "\n";
        $html .= $this->renderFooter() . "\n";
        $html .= Html::closeTag('div') . "\n"; // .modal-card
        $html .= Html::closeTag('div'); // .modal

        return $html;
    }

    /**
     * Renders the background transparent overlay.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderBackgroundTransparentOverlay(): string
    {
        return Div::tag()->class($this->backgroundClass)->render();
    }

    /**
     * Renders begin body tag.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderBodyBegin(): string
    {
        $bodyAttributes = $this->bodyAttributes;

        Html::addCssClass($bodyAttributes, $this->bodyClass);

        return Html::openTag('section', $bodyAttributes);
    }

    /**
     * Renders end body tag.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderBodyEnd(): string
    {
        return Html::closeTag('section');
    }

    /**
     * Renders the close button.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderCloseButton(): string
    {
        $closeButtonAttributes = $this->closeButtonAttributes;
        $closeButtonAttributes['aria-label'] = 'close';

        Html::addCssClass($closeButtonAttributes, $this->closeButtonClass);

        if ($this->closeButtonSize !== '') {
            Html::addCssClass($closeButtonAttributes, $this->closeButtonSize);
        }

        return Button::tag()->attributes($closeButtonAttributes)->render() . PHP_EOL;
    }

    /**
     * Renders the footer.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderFooter(): string
    {
        $footer = $this->footer;
        $footerAttributes = $this->footerAttributes;

        if ($footer !== '') {
            $footer = PHP_EOL . $footer . PHP_EOL;
        }

        Html::addCssClass($footerAttributes, $this->footClass);

        return CustomTag::name('footer')->attributes($footerAttributes)->content($footer)->encode(false)->render();
    }

    /**
     * Renders header.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderHeader(): string
    {
        $content = '';
        $headerAttributes = $this->headerAttributes;
        $titleAttributes = $this->titleAttributes;

        Html::addCssClass($headerAttributes, $this->headClass);
        Html::addCssClass($titleAttributes, $this->titleClass);

        $content .= P::tag()->attributes($titleAttributes)->content($this->title)->render() . PHP_EOL;

        if ($this->withoutCloseButton === false) {
            $content .= $this->renderCloseButton();
        }

        return CustomTag::name('header')
            ->attributes($headerAttributes)
            ->content(PHP_EOL . $content)
            ->encode(false)
            ->render() . PHP_EOL;
    }

    /**
     * Renders the toggle button.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderToggleButton(string $id): string
    {
        $toggleButtonAttributes = $this->toggleButtonAttributes;

        if (!array_key_exists('id', $toggleButtonAttributes)) {
            $toggleButtonAttributes['id'] = Html::generateId($this->autoIdPrefix) . '-button';
        }

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
}
