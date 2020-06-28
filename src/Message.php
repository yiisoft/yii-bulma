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
 * <?= Message::widget()
 *     ->headerColor('success')
 *     ->header('System info')
 *     ->body('Say hello...') ?>
 * ```
 */
final class Message extends Widget
{
    private string $body = '';
    private string $headerColor = 'is-dark';
    private string $headerMessage = '';
    private array $options = [];
    private array $optionsBody = [];
    private array $optionsCloseButton = [];
    private array $optionsHeader = [];
    private string $size = '';
    private bool $withoutCloseButton = false;
    private bool $withoutHeader = true;

    protected function run(): string
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-message";
        }

        $this->options = $this->addOptions($this->options, 'message');

        Html::addCssClass($this->options, $this->headerColor);

        if ($this->size !== '') {
            Html::addCssClass($this->options, $this->size);
        }

        $this->optionsBody = $this->addOptions($this->optionsBody, 'message-body');
        $this->optionsCloseButton = $this->addOptions($this->optionsCloseButton, 'delete');
        $this->optionsHeader = $this->addOptions($this->optionsHeader, 'message-header');

        return
            Html::beginTag('div', $this->options) . "\n" .
                $this->renderHeader() .
                Html::beginTag('div', $this->optionsBody) . "\n" .
                    $this->renderBodyEnd() . "\n" .
                Html::endTag('div') . "\n" .
            Html::endTag('div');
    }

    /**
     * The body content in the message component. Message widget will also be treated as the body content, and will be
     * rendered before this.
     *
     * @param string $value
     *
     * @return self
     */
    public function body(string $value): self
    {
        $this->body = $value;
        return $this;
    }

    /**
     * Set color header message.
     *
     * @param string $value setting default 'is-dark', 'is-primary', 'is-link', 'is-info', 'is-success', 'is-warning',
     * 'is-danger'.
     *
     * @return self
     */
    public function headerColor(string $value): self
    {
        $this->headerColor = $value;
        return $this;
    }

    /**
     * The header message in the message component. Message widget will also be treated as the header content, and will
     * be rendered before body.
     *
     * @param string $value
     *
     * @return self
     */
    public function headerMessage(string $value): self
    {
        $this->headerMessage = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget container tag. The following special options are recognized.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function options(array $value): self
    {
        $this->options = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget body tag. The following special options are recognized.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function optionsBody(array $value): self
    {
        $this->optionsBody = $value;
        return $this;
    }

    /**
     * The options for rendering the close button tag.
     *
     * The close button is displayed in the header of the modal window. Clicking on the button will hide the modal
     * window. If {@see withoutCloseButton} is false, no close button will be rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function optionsCloseButton(array $value): self
    {
        $this->optionsCloseButton = $value;
        return $this;
    }

    /**
     * The HTML attributes for the widget header tag. The following special options are recognized.
     *
     * {@see \Yiisoft\Html\Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function optionsHeader(array $value): self
    {
        $this->optionsHeader = $value;
        return $this;
    }

    /**
     * Set size message widget.
     *
     * @param string $value default setting empty normal, 'is-small', 'is-medium', 'is-large'.
     *
     * @return self
     */
    public function size(string $value): self
    {
        $this->size = $value;
        return $this;
    }

    /**
     * Allows you to disable close button message widget.
     *
     * @param bool $value
     *
     * @return self
     */
    public function withoutCloseButton(bool $value): self
    {
        $this->withoutCloseButton = $value;
        return $this;
    }

    /**
     * Allows you to disable header widget.
     *
     * @param bool $value
     *
     * @return self
     */
    public function withoutHeader(bool $value): self
    {
        $this->withoutHeader = $value;
        return $this;
    }

    private function renderHeader(): string
    {
        $html = '';

        if ($this->withoutHeader) {
            $html = Html::beginTag('div', $this->optionsHeader) . "\n" . $this->renderHeaderMessage() . "\n" .
                Html::endTag('div') . "\n";
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

        $tag = ArrayHelper::remove($this->optionsCloseButton, 'tag', 'button');
        $label = ArrayHelper::remove($this->optionsCloseButton, 'label', Html::tag('span', '&times;', [
            'aria-hidden' => 'true'
        ]));

        if ($tag === 'button') {
            $this->optionsCloseButton['type'] = 'button';
        }

        if ($this->size !== '') {
            Html::addCssClass($this->optionsCloseButton, [$this->size]);
        }

        return Html::tag($tag, $label, $this->optionsCloseButton);
    }
}
