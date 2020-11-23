<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Html\Html;

/**
 * Progress Bar widget
 * Native HTML progress bar
 *
 * ```php
 * echo ProgressBar::widget()->progressValue(75);
 * ```
 *
 * @link https://bulma.io/documentation/elements/progress/
 */
final class ProgressBar extends Widget
{
    private array $options = [];
    private ?float $progressValue = null;
    private ?int $progressMax = 100;
    private string $size = '';
    private string $color = '';

    protected function run(): string
    {
        $this->buildOptions();

        return $this->renderProgressBar();
    }

    private function renderProgressBar(): string
    {
        $content = $this->progressValue !== null
            ? $this->progressValue . '%'
            : '';

        return Html::tag('progress', $content, $this->options);
    }

    private function buildOptions(): void
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = "{$this->getId()}-progressbar";
        }

        $this->options = $this->addOptions($this->options, 'progress');

        if ($this->progressMax !== null) {
            $this->options['max'] = $this->progressMax;
        }

        if ($this->progressValue !== null) {
            $this->options['value'] = $this->progressValue;
        }

        if ($this->size !== '') {
            Html::addCssClass($this->options, $this->size);
        }

        if ($this->color !== '') {
            Html::addCssClass($this->options, $this->color);
        }
    }

    /**
     * The HTML attributes for the widget container tag.
     */
    public function options(array $value): self
    {
        $new = clone $this;
        $new->options = $value;

        return $new;
    }

    /**
     * The value of the progress. Set null if need remove value attribute.
     *
     * @var float|null $value
     *
     * @return self
     */
    public function progressValue(?float $value): self
    {
        $new = clone $this;
        $new->progressValue = $value;

        return $new;
    }

    /**
     * Maximum progress value. Set null if need remove max attribute.
     *
     * @var int|null $value
     *
     * @return self
     */
    public function progressMax(?int $value): self
    {
        $new = clone $this;
        $new->progressMax = $value;

        return $new;
    }

    /**
     * Set size progress bar.
     *
     * @var string $value
     *
     * @param string $value default setting empty, 'is-small', 'is-medium', 'is-large'.
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
     * Set color progress bar.
     *
     * @var string $value
     *
     * @param string $value default setting empty, 'is-primary', 'is-link', 'is-info', 'is-success', 'is-warning', 'is-danger'.
     *
     * @return self
     */
    public function color(string $value): self
    {
        $new = clone $this;
        $new->color = $value;

        return $new;
    }
}
