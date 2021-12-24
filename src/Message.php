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

/**
 * Message renders Bulma message component.
 *
 * For example,
 *
 * ```php
 * <?= Message::widget()->headerColor('success')->header('System info')->body('Say hello...') ?>
 * ```
 *
 * @link https://bulma.io/documentation/components/message/
 */
final class Message extends Widget
{
    private array $attributes = [];
    private string $autoIdPrefix = 'w';
    private string $body = '';
    private array $bodyAttributes = [];
    private array $buttonSpanAttributes = [];
    private string $buttonSpanAriaHidden = 'true';
    private string $buttonCssClass = 'delete';
    private array $closeButtonAttributes = [];
    private bool $encode = false;
    private array $headerAttributes = [];
    private string $headerColor = 'is-dark';
    private string $headerMessage = '';
    private string $messageBodyCssClass = 'message-body';
    private string $messageCssClass = 'message';
    private string $messageHeaderMessageCssClass = 'message-header';
    private string $size = '';
    private bool $unclosedButton = false;
    private bool $withoutHeader = true;

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
     * The body content in the message component. Message widget will also be treated as the body content, and will be
     * rendered before this.
     *
     * @param string $value The body content in the message component.
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
     * The HTML attributes for the widget body tag.
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
     * The attributes for rendering the close button tag.
     *
     * The close button is displayed in the header of the modal window. Clicking on the button will hide the modal
     * window. If {@see unclosedButton} is false, no close button will be rendered.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function closeButtonAttributes(array $values): self
    {
        $new = clone $this;
        $new->closeButtonAttributes = $values;
        return $new;
    }

    /**
     * Set encode to true to encode the output.
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
     * Set color header message.
     *
     * @param string $value setting default 'is-dark'. Possible values: 'is-primary', 'is-info', 'is-success',
     * 'is-link', 'is-warning', 'is-danger'.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/message/#colors
     */
    public function headerColor(string $value): self
    {
        $headerColor = ['is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger', 'is-dark'];

        if (!in_array($value, $headerColor)) {
            $values = implode(' ', $headerColor);
            throw new InvalidArgumentException("Invalid color. Valid values are: $values.");
        }

        $new = clone $this;
        $new->headerColor = $value;
        return $new;
    }

    /**
     * The header message in the message component. Message widget will also be treated as the header content, and will
     * be rendered before body.
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
     * The HTML attributes for the widget header tag.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return self
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     */
    public function headerAttributes(array $values): self
    {
        $new = clone $this;
        $new->headerAttributes = $values;
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
     * Set size config widgets.
     *
     * @param string $value size class.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/message/#sizes
     */
    public function size(string $value): self
    {
        if (!in_array($value, ['is-small', 'is-medium', 'is-large'])) {
            $values = implode(' ', ['is-small', 'is-medium', 'is-large']);
            throw new InvalidArgumentException("Invalid size. Valid values are: $values.");
        }

        $new = clone $this;
        $new->size = $value;
        return $new;
    }

    /**
     * Allows you to disable close button message widget.
     *
     * @return self
     */
    public function unclosedButton(): self
    {
        $new = clone $this;
        $new->unclosedButton = true;
        return $new;
    }

    /**
     * Allows you to disable header widget.
     *
     * @return self
     *
     * @link https://bulma.io/documentation/components/message/#message-body-only
     */
    public function withoutHeader(): self
    {
        $new = clone $this;
        $new->withoutHeader = false;
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

        if ($this->unclosedButton === true) {
            return $html;
        }

        $buttonSpanAttributes['aria-hidden'] = $this->buttonSpanAriaHidden;
        $closeButtonAttributes['type'] = 'button';

        Html::addCssClass($closeButtonAttributes, $this->buttonCssClass);
        unset($closeButtonAttributes['label']);

        $label = Span::tag()->attributes($buttonSpanAttributes)->content('&times;')->encode(false)->render();

        if ($this->size !== '') {
            Html::addCssClass($closeButtonAttributes, $this->size);
        }

        return Button::tag()->attributes($closeButtonAttributes)->content($label)->encode(false)->render() . PHP_EOL;
    }

    private function renderHeader(): string
    {
        $html = '';

        $headerAttributes = $this->headerAttributes;
        $headerMessage = $this->headerMessage;

        Html::addCssClass($headerAttributes, $this->messageHeaderMessageCssClass);

        $renderCloseButton = $this->renderCloseButton();

        if ($this->encode) {
            $headerMessage = Html::encode($headerMessage);
        }

        if ($renderCloseButton !== '') {
            $headerMessage = PHP_EOL . P::tag()->content($headerMessage) . PHP_EOL . $renderCloseButton;
        }

        if ($this->withoutHeader) {
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

        Html::addCssClass($attributes, $this->messageCssClass);
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

        Html::addCssClass($bodyAttributes, $this->messageBodyCssClass);

        if ($this->encode) {
            $body = Html::encode($body);
        }

        if ($body !== '') {
            $body = PHP_EOL . $body . PHP_EOL;
        }

        return Div::tag()->attributes($bodyAttributes)->content($body)->encode(false)->render() . PHP_EOL;
    }
}
