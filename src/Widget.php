<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use Yiisoft\Widget\Widget as BaseWidget;

abstract class Widget extends BaseWidget
{
    private ?string $id = null;
    private bool $autoGenerate = true;
    private string $autoIdPrefix = 'w';
    private static int $counter = 0;

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
     * Set the Id of the widget.
     */
    public function id(string $value): self
    {
        $this->id = $value;
        return $this;
    }

    /**
     * Counter used to generate {@see id} for widgets.
     */
    public static function counter(int $value): void
    {
        self::$counter = $value;
    }

    /**
     * The prefix to the automatically generated widget IDs.
     *
     * {@see getId()}
     */
    public function autoIdPrefix(string $value): self
    {
        $this->autoIdPrefix = $value;
        return $this;
    }
}
