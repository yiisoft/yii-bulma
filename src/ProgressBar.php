<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Html\Html;

use function implode;
use function in_array;

/**
 * Progress Bar widget.
 * Native HTML progress bar.
 *
 * ```php
 * echo ProgressBar::widget()->value(75);
 * ```
 *
 * @link https://bulma.io/documentation/elements/progress/
 */
final class ProgressBar extends Widget
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
    private float $value = 0;
    private int $maxValue = 100;
    private string $size = '';
    private string $color = '';

    protected function run(): string
    {
        $this->buildOptions();

        $content = $this->value > 0 ? $this->value . '%' : '';

        return Html::tag('progress', $content, $this->options)->render();
    }

    /**
     * HTML attributes for the widget container tag.
     *
     * @param array $value The HTML attributes for the widget container tag.
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
     * Sets the value of the progress.
     *
     * @param float $value The value of the progress. Set `0` to display loading animation.
     *
     * @return self
     */
    public function value(float $value): self
    {
        $new = clone $this;
        $new->value = $value;

        return $new;
    }

    /**
     * Sets maximum progress value.
     *
     * @param int $value Maximum progress value. Set `0` for no maximum.
     *
     * @return self
     */
    public function maxValue(int $value): self
    {
        $new = clone $this;
        $new->maxValue = $value;

        return $new;
    }

    /**
     * Sets progress bar size.
     *
     * @param string $value Size class.
     *
     * @return self
     */
    public function size(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL, true)) {
            $values = implode('"', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->size = $value;

        return $new;
    }

    /**
     * Sets progress bar color.
     *
     * @param string $value Color class.
     *
     * @return self
     */
    public function color(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL, true)) {
            $values = implode('"', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->color = $value;

        return $new;
    }

    private function buildOptions(): void
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-progressbar";
        }

        $this->options = $this->addOptions($this->options, 'progress');

        if ($this->maxValue > 0) {
            $this->options['max'] = $this->maxValue;
        }

        if ($this->value > 0) {
            $this->options['value'] = $this->value;
        }

        if ($this->size !== '') {
            Html::addCssClass($this->options, $this->size);
        }

        if ($this->color !== '') {
            Html::addCssClass($this->options, $this->color);
        }
    }
}
