<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Html\Html;
use Yiisoft\Widget\Widget as BaseWidget;

use function implode;
use function is_array;
use function strpos;

abstract class Widget extends BaseWidget
{
    private ?string $id = null;
    private bool $autoGenerate = true;
    private string $autoIdPrefix = 'w';
    private static int $counter = 0;

    /**
     * Returns a new instance with the specified ID of the widget.
     *
     * @param string $value The the ID of the widget.
     *
     * @return static
     */
    public function id(string $value): self
    {
        $new = clone $this;
        $new->id = $value;
        return $new;
    }

    /**
     * Counter used to generate {@see id()} for widgets.
     *
     * @param int $value
     */
    public static function counter(int $value): void
    {
        self::$counter = $value;
    }

    /**
     * Returns a new instance with the specified prefix to the automatically generated widget IDs.
     *
     * @param string $value The prefix to the automatically generated widget IDs.
     *
     * @return static
     *
     * {@see getId()}
     */
    public function autoIdPrefix(string $value): self
    {
        $new = clone $this;
        $new->autoIdPrefix = $value;
        return $new;
    }

    /**
     * Returns the ID of the widget.
     *
     * @return string|null ID of the widget.
     */
    protected function getId(): ?string
    {
        if ($this->autoGenerate && $this->id === null) {
            $this->id = $this->autoIdPrefix . ++self::$counter;
        }

        return $this->id;
    }

    /**
     * Validates CSS class default options.
     *
     * @param array $options
     * @param string $defaultClass
     *
     * @return array
     */
    protected function addOptions(array $options, string $defaultClass): array
    {
        $class = '';

        if (isset($options['class'])) {
            /** @var string|string[] $class */
            $class = $options['class'];
            unset($options['class']);

            if (is_array($class)) {
                $class = implode(' ', $class);
            }
        }

        if (strpos($class, $defaultClass) === false) {
            Html::addCssClass($options, $defaultClass);
        }

        if (!empty($class)) {
            Html::addCssClass($options, $class);
        }

        return $options;
    }
}
