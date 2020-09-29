<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Html\Html;
use Yiisoft\Widget\Widget as BaseWidget;

abstract class Widget extends BaseWidget
{
    private ?string $id = null;
    private bool $autoGenerate = true;
    private string $autoIdPrefix = 'w';
    private static int $counter = 0;

    /**
     * Set the Id of the widget.
     *
     * @param string $value
     *
     * @return Widget
     */
    public function id(string $value): self
    {
        $this->id = $value;
        return $this;
    }

    /**
     * Counter used to generate {@see id} for widgets.
     *
     * @param int $value
     */
    public static function counter(int $value): void
    {
        self::$counter = $value;
    }

    /**
     * The prefix to the automatically generated widget IDs.
     *
     * @param string $value
     *
     * @return Widget
     *
     * {@see getId()}
     */
    public function autoIdPrefix(string $value): self
    {
        $this->autoIdPrefix = $value;
        return $this;
    }

    /**
     * Returns the Id of the widget.
     *
     * @return string|null Id of the widget.
     */
    protected function getId(): ?string
    {
        if ($this->autoGenerate && $this->id === null) {
            $this->id = $this->autoIdPrefix . ++self::$counter;
        }

        return $this->id;
    }

    /**
     * Validate CSS class default options.
     *
     * @param array $options
     * @param string $valueDefault
     *
     * @return array|null
     */
    protected function addOptions(array $options, string $valueDefault): ?array
    {
        $optionsTmp = '';

        if (isset($options['class'])) {
            $optionsTmp = $options['class'];

            unset($options['class']);
        }

        if (strpos($optionsTmp, $valueDefault) === false) {
            Html::addCssClass($options, $valueDefault);
        }

        if (!empty($optionsTmp)) {
            Html::addCssClass($options, $optionsTmp);
        }

        return $options;
    }
}
