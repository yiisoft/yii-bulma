<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\CustomTag;
use Yiisoft\Widget\Widget;

use function array_key_exists;
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
    private string $color = '';
    private string $size = '';

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
     * Returns a new instance with the specified progress bar color.
     *
     * @param string $value The progress bar color. By default there is no color.
     * Possible values: ProgressBar::COLOR_PRIMARY, ProgressBar::COLOR_LINK, ProgressBar::COLOR_INFO,
     * ProgressBar::COLOR_SUCCESS, ProgressBar::COLOR_WARNING, ProgressBar::COLOR_DANGER, ProgressBar::COLOR_DARK.
     *
     * @return self
     */
    public function color(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL, true)) {
            $values = implode('", "', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->color = $value;
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
     * Returns a new instance with the specified maximum progress value.
     *
     * @param int|null $value Maximum progress value. Set `0` for no maximum.
     *
     * @return self
     */
    public function maxValue(?int $value): self
    {
        if ($value < 0 || $value > 100) {
            throw new InvalidArgumentException('Invalid max value. It must be between 0 and 100.');
        }

        $new = clone $this;
        $new->attributes['max'] = $value;
        return $new;
    }

    /**
     * Returns a new instance with the specified progress bar size class.
     *
     * @param string $value The progress bar size class. Default setting is "normal".
     * Possible values: ProgressBar::SIZE_SMALL, ProgressBar::SIZE_MEDIUM, Model::SIZE_LARGE.
     *
     * @return self
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
     * Returns a new instance with the specified value of the progress.
     *
     * @param float|null $value The value of the progress. Set `0` to display loading animation.
     *
     * @return self
     */
    public function value(?float $value): self
    {
        if ($value < 0 || $value > 100) {
            throw new InvalidArgumentException('Invalid value. It must be between 0 and 100.');
        }

        $new = clone $this;
        $new->attributes['value'] = $value;
        return $new;
    }

    protected function run(): string
    {
        $attributes = $this->build($this->attributes);
        $content = '';

        if (array_key_exists('value', $attributes)) {
            /** @var float|null */
            $attributes['value'] = $attributes['value'] === 0.0 ? null : $attributes['value'];
            $content = $attributes['value'] > 0 ? $attributes['value'] . '%' : '';
        }

        return CustomTag::name('progress')->attributes($attributes)->content($content)->render();
    }

    private function build(array $attributes): array
    {
        if (!array_key_exists('id', $attributes)) {
            /** @var string */
            $attributes['id'] = (Html::generateId($this->autoIdPrefix) . '-progressbar');
        }

        if (array_key_exists('max', $attributes)) {
            /** @var int|null */
            $attributes['max'] = $attributes['max'] === 0 ? null : $attributes['max'];
        } else {
            $attributes['max'] = 100;
        }

        Html::addCssClass($attributes, 'progress');

        if ($this->size !== '') {
            Html::addCssClass($attributes, $this->size);
        }

        if ($this->color !== '') {
            Html::addCssClass($attributes, $this->color);
        }

        return $attributes;
    }
}
