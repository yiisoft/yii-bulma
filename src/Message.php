<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Html\Tag\P;
use Yiisoft\Html\Tag\Span;
use Yiisoft\Widget\Widget;

use function implode;
use function in_array;

/**
 * Message renders Bulma message component.
 *
 * For example,
 *
 * ```php
 * <?= Message::widget()
 *     ->headerColor('success')
 *     ->header('System info')
 *     ->body('Say hello...') ?>
 * ```
 *
 * @link https://bulma.io/documentation/components/message/
 */
final class Message extends Widget
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
    private string $body = '';
    private array $bodyAttributes = [];
    private string $bodyCssClass = 'message-body';
    private array $buttonSpanAttributes = [];
    private string $buttonSpanAriaHidden = 'true';
    private string $buttonCssClass = 'delete';
    private string $cssClass = 'message';
    private bool $closedButton = false;
    private array $closeButtonAttributes = [];
    private bool $encode = false;
    private array $headerAttributes = [];
    private string $headerColor = self::COLOR_DARK;
    private string $headerMessage = '';
    private string $headerMessageCssClass = 'message-header';
    private string $size = '';
    private bool $withoutHeader = false;

    /**
     * Returns a new instance with the specified HTML attributes for widget.
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
     * Returns a new instance with the specified the body content.
     *
     * @param string $value The body content.
     *
     * @return self
     */
    public function body(string $value): self
    {
        $new = clone $this;
        $new->body = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the widget body tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function bodyAttributes(array $values): self
    {
        $new = clone $this;
        $new->bodyAttributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified the CSS class for the body container.
     *
     * @param string $value The CSS class for the body container.
     *
     * @return self
     */
    public function bodyCssClass(string $value): self
    {
        $new = clone $this;
        $new->bodyCssClass = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the close button tag.
     *
     * The close button is displayed in the header of the Message. Clicking on the button will hide the message.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} For details on how attributes are being rendered.
     */
    public function closeButtonAttributes(array $values): self
    {
        $new = clone $this;
        $new->closeButtonAttributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified whether the tags for the message are encoded.
     *
     * @param bool $value whether to encode the output.
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
     * Returns a new instance with the specified HTML attributes for the widget header tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} For details on how attributes are being rendered.
     */
    public function headerAttributes(array $values): self
    {
        $new = clone $this;
        $new->headerAttributes = $values;
        return $new;
    }

    /**
     * Returns a new instance with the specified message header color.
     *
     * @param string $value The header color. Default is Message::COLOR_DARK.
     * Possible values: Message::COLOR_PRIMARY, Message::COLOR_LINK, Message::COLOR_INFO, Message::COLOR_SUCCESS,
     * Message::COLOR_WARNING, Message::COLOR_DANGER, Message::COLOR_DARK.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/message/#colors
     */
    public function headerColor(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL, true)) {
            $values = implode('", "', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->headerColor = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified the header message.
     *
     * @param string $value The header message.
     *
     * @return self
     */
    public function headerMessage(string $value): self
    {
        $new = clone $this;
        $new->headerMessage = $value;
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
     * Returns a new instance with the specified size for the widget.
     *
     * @param string $value size class. By default, not class is added and the size is considered "normal".
     * Possible values: Message::SIZE_SMALL, Message::SIZE_MEDIUM, Message::SIZE_LARGE.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/message/#sizes
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
     * Returns a new instance with the specified allows you to remove the close button.
     *
     * @param bool $value Whether to remove the close button.
     *
     * @return self
     */
    public function withoutCloseButton(bool $value): self
    {
        $new = clone $this;
        $new->closedButton = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified allows you to disable header.
     *
     * @param bool $value Whether to disable header.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/message/#message-body-only
     */
    public function withoutHeader(bool $value): self
    {
        $new = clone $this;
        $new->withoutHeader = $value;
        return $new;
    }

    protected function run(): string
    {
        return $this->renderMessage();
    }

    private function renderCloseButton(): string
    {
        $html = '';

        $buttonSpanAttributes = $this->buttonSpanAttributes;
        $closeButtonAttributes = $this->closeButtonAttributes;

        if ($this->closedButton === true) {
            return $html;
        }

        $buttonSpanAttributes['aria-hidden'] = $this->buttonSpanAriaHidden;
        $closeButtonAttributes['type'] = 'button';

        Html::addCssClass($closeButtonAttributes, $this->buttonCssClass);
        unset($closeButtonAttributes['label']);

        $label = Span::tag()
            ->attributes($buttonSpanAttributes)
            ->content('&times;')
            ->encode(false)
            ->render();

        if ($this->size !== '') {
            Html::addCssClass($closeButtonAttributes, $this->size);
        }

        return Button::tag()
                ->attributes($closeButtonAttributes)
                ->content($label)
                ->encode(false)
                ->render() . PHP_EOL;
    }

    private function renderHeader(): string
    {
        $html = '';

        $headerAttributes = $this->headerAttributes;
        $headerMessage = $this->headerMessage;

        Html::addCssClass($headerAttributes, $this->headerMessageCssClass);

        $renderCloseButton = $this->renderCloseButton();

        if ($this->encode) {
            $headerMessage = Html::encode($headerMessage);
        }

        if ($renderCloseButton !== '') {
            $headerMessage = PHP_EOL . P::tag()->content($headerMessage) . PHP_EOL . $renderCloseButton;
        }

        if ($this->withoutHeader === false) {
            $html = Div::tag()
                    ->attributes($headerAttributes)
                    ->content($headerMessage)
                    ->encode(false)
                    ->render() . PHP_EOL;
        }

        return $html;
    }

    private function renderMessage(): string
    {
        $attributes = $this->attributes;

        /** @var string */
        $id = $attributes['id'] ?? (Html::generateId($this->autoIdPrefix) . '-message');
        unset($attributes['id']);

        Html::addCssClass($attributes, $this->cssClass);
        Html::addCssClass($attributes, $this->headerColor);

        if ($this->size !== '') {
            Html::addCssClass($attributes, $this->size);
        }

        return Div::tag()
            ->attributes($attributes)
            ->content(PHP_EOL . $this->renderHeader() . $this->renderMessageBody())
            ->encode(false)
            ->id($id)
            ->render();
    }

    private function renderMessageBody(): string
    {
        $body = $this->body;
        $bodyAttributes = $this->bodyAttributes;

        Html::addCssClass($bodyAttributes, $this->bodyCssClass);

        if ($this->encode) {
            $body = Html::encode($body);
        }

        if ($body !== '') {
            $body = PHP_EOL . $body . PHP_EOL;
        }

        return Div::tag()
                ->attributes($bodyAttributes)
                ->content($body)
                ->encode(false)
                ->render() . PHP_EOL;
    }
}
