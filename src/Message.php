<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Arrays\ArrayHelper;
use Yiisoft\Html\Html;

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
    private string $body = '';
    private string $headerColor = 'is-dark';
    private string $headerMessage = '';
    private array $options = [];
    private array $bodyOptions = [];
    private array $closeButtonOptions = [];
    private array $headerOptions = [];
    private string $size = '';
    private bool $withoutCloseButton = false;
    private bool $withoutHeader = true;

    protected function run(): string
    {
        $this->buildOptions();

        return
            Html::openTag('div', $this->options) . "\n" .
            $this->renderHeader() .
            Html::openTag('div', $this->bodyOptions) . "\n" .
            $this->renderBodyEnd() . "\n" .
            Html::closeTag('div') . "\n" .
            Html::closeTag('div');
    }

    /**
     * Returns a new instance with the specified message body.
     *
     * @param string $value The body content in the message component.
     * Message widget will also be treated as the body content, and will be rendered before this.
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
     * Returns a new instance with the specified color header message.
     *
     * @param string $value Setting default 'is-dark', 'is-primary', 'is-link', 'is-info', 'is-success', 'is-warning',
     * 'is-danger'.
     *
     * @return self
     */
    public function headerColor(string $value): self
    {
        $new = clone $this;
        $new->headerColor = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified header message.
     *
     * @param string $value The header message in the message component.
     * Message widget will also be treated as the header content, and will be rendered before body.
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
     * Returns a new instance with the specified HTML attributes for the widget container tag.
     *
     * @param array $value The HTML attributes for the widget container tag.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
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
     * Returns a new instance with the specified HTML attributes for the widget body tag.
     *
     * @param array $value The HTML attributes for the widget body tag.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function bodyOptions(array $value): self
    {
        $new = clone $this;
        $new->bodyOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified options for rendering the close button tag.
     *
     * @param array $value The close button is displayed in the header of the modal window. Clicking on the button
     * will hide the modal window. If {@see withoutCloseButton} is false, no close button will be rendered.
     *
     * @return self
     */
    public function closeButtonOptions(array $value): self
    {
        $new = clone $this;
        $new->closeButtonOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified HTML attributes for the widget header tag.
     *
     * @param array $value The HTML attributes for the widget header tag.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @return self
     */
    public function headerOptions(array $value): self
    {
        $new = clone $this;
        $new->headerOptions = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified size message widget.
     *
     * @param string $value The size message widget. Default setting empty normal, 'is-small', 'is-medium', 'is-large'.
     *
     * @return self
     */
    public function size(string $value): self
    {
        $new = clone $this;
        $new->size = $value;
        return $new;
    }

    /**
     * Returns a new instance with the disabled close button message widget.
     *
     * @return self
     */
    public function closeButton(): self
    {
        $new = clone $this;
        $new->withoutCloseButton = true;
        return $new;
    }

    /**
     * Returns a new instance with the disabled header message.
     *
     * @return self
     */
    public function withoutHeader(): self
    {
        $new = clone $this;
        $new->withoutHeader = false;
        return $new;
    }

    private function buildOptions(): void
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-message";
        }

        $this->options = $this->addOptions($this->options, 'message');

        Html::addCssClass($this->options, $this->headerColor);

        if ($this->size !== '') {
            Html::addCssClass($this->options, $this->size);
        }

        $this->bodyOptions = $this->addOptions($this->bodyOptions, 'message-body');
        $this->closeButtonOptions = $this->addOptions($this->closeButtonOptions, 'delete');
        $this->headerOptions = $this->addOptions($this->headerOptions, 'message-header');
    }

    private function renderHeader(): string
    {
        $html = '';

        if ($this->withoutHeader) {
            $html = Html::openTag('div', $this->headerOptions) . "\n" . $this->renderHeaderMessage() . "\n" .
                Html::closeTag('div') . "\n";
        }

        return $html;
    }

    private function renderHeaderMessage(): string
    {
        $result = $this->headerMessage;

        if ($this->renderCloseButton() !== null) {
            $result = '<p>' . $this->headerMessage . '</p>' . "\n" . $this->renderCloseButton();
        }

        return $result;
    }

    private function renderBodyEnd(): string
    {
        return $this->body;
    }

    private function renderCloseButton(): ?string
    {
        if ($this->withoutCloseButton === true) {
            return null;
        }

        $spanOptions = ['aria-hidden' => 'true'];
        $tag = ArrayHelper::remove($this->closeButtonOptions, 'tag', 'button');
        $label = ArrayHelper::remove(
            $this->closeButtonOptions,
            'label',
            Html::tag('span', '&times;', $spanOptions)->encode(false)->render()
        );

        if ($tag === 'button') {
            $this->closeButtonOptions['type'] = 'button';
        }

        if ($this->size !== '') {
            Html::addCssClass($this->closeButtonOptions, $this->size);
        }

        return Html::tag($tag, $label ?? '', $this->closeButtonOptions)->encode(false)->render();
    }
}
