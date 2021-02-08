<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use JsonException;
use Yiisoft\Html\Html;

/**
 * Modal renders a modal window that can be toggled by clicking on a button.
 *
 * The following example will show the content enclosed between the {@see begin()} and {@see end()} calls within the
 * modal window:
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
    private const COLOR_ALL = [
        self::COLOR_PRIMARY,
        self::COLOR_LINK,
        self::COLOR_INFO,
        self::COLOR_SUCCESS,
        self::COLOR_WARNING,
        self::COLOR_DANGER,
    ];

    private array $options = [];
    private array $contentOptions = [];
    private array $closeButtonOptions = [];
    private string $closeButtonSize = '';
    private bool $withoutCloseButton = true;
    private string $toggleButtonLabel = 'Toggle button';
    private string $toggleButtonSize = '';
    private string $toggleButtonColor = '';
    private array $toggleButtonOptions = [];
    private bool $withoutToggleButton = true;

    public function begin(): ?string
    {
        parent::begin();

        $this->buildOptions();

        $html = '';
        $html .= $this->renderToggleButton() . "\n";
        $html .= Html::beginTag('div', $this->options) . "\n"; // .modal
        $html .= Html::tag('div', '', ['class' => 'modal-background']) . "\n";
        $html .= $this->renderCloseButton() . "\n";
        $html .= Html::beginTag('div', $this->contentOptions) . "\n"; // .modal-content

        return $html;
    }

    protected function run(): string
    {
        $html = '';
        $html .= Html::endTag('div') . "\n"; // .modal-content
        $html .= Html::endTag('div'); // .modal

        return $html;
    }

    /**
     * Main container options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
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
     * Toggle button label.
     *
     * @param string $value
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
     * Toggle button options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function toggleButtonOptions(array $value): self
    {
        $new = clone $this;
        $new->toggleButtonOptions = $value;

        return $new;
    }

    /**
     * Toggle button size.
     *
     * @param string $value
     *
     * @return self
     */
    public function toggleButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL)) {
            $values = implode('", "', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->toggleButtonSize = $value;

        return $new;
    }

    /**
     * Toggle button color.
     *
     * @param string $value
     *
     * @return self
     */
    public function toggleButtonColor(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL)) {
            $values = implode('", "', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->toggleButtonColor = $value;

        return $new;
    }

    /**
     * Disable toggle button.
     *
     * @return self
     */
    public function withoutToggleButton(): self
    {
        $new = clone $this;
        $new->withoutToggleButton = false;

        return $new;
    }

    /**
     * Close button size.
     *
     * @param string $value
     *
     * @return self
     */
    public function closeButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL)) {
            $values = implode('"', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->closeButtonSize = $value;

        return $new;
    }

    /**
     * Close button options
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
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
     * Disable close button.
     *
     * @param bool $value
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
     * Content options.
     *
     * {@see Html::renderTagAttributes()} for details on how attributes are being rendered.
     *
     * @param array $value
     *
     * @return self
     */
    public function contentOptions(array $value): self
    {
        $new = clone $this;
        $new->contentOptions = $value;

        return $new;
    }

    /**
     * Renders the toggle button.
     *
     * @throws JsonException
     *
     * @return string
     */
    private function renderToggleButton(): string
    {
        if ($this->withoutToggleButton) {
            return Html::button($this->toggleButtonLabel, $this->toggleButtonOptions);
        }

        return '';
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
        if ($this->withoutCloseButton) {
            return Html::button('', $this->closeButtonOptions);
        }

        return '';
    }

    private function buildOptions(): void
    {
        $this->options['id'] ??= "{$this->getId()}-modal";
        $this->options = $this->addOptions($this->options, 'modal');

        $this->contentOptions = $this->addOptions($this->contentOptions, 'modal-content');

        $this->closeButtonOptions = $this->addOptions($this->closeButtonOptions, 'modal-close');
        $this->closeButtonOptions['aria-label'] = 'close';

        if ($this->closeButtonSize !== '') {
            Html::addCssClass($this->closeButtonOptions, $this->closeButtonSize);
        }

        $this->toggleButtonOptions = $this->addOptions($this->toggleButtonOptions, 'button');
        $this->toggleButtonOptions['data-target'] = '#' . $this->options['id'];
        $this->toggleButtonOptions['aria-haspopup'] = 'true';

        if ($this->toggleButtonSize !== '') {
            Html::addCssClass($this->toggleButtonOptions, $this->toggleButtonSize);
        }

        if ($this->toggleButtonColor !== '') {
            Html::addCssClass($this->toggleButtonOptions, $this->toggleButtonColor);
        }
    }
}
