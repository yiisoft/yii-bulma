<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Widget\Exception\InvalidConfigException;

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
    private string $launchButtonLabel = 'Launch modal';
    private string $launchButtonSize = '';
    private string $launchButtonColor = '';
    private array $launchButtonOptions = [];
    private bool $start = false;

    public function start(): string
    {
        $this->start = true;
        $this->buildOptions();

        return implode("\n", [
            $this->renderLaunchButton(),
            Html::beginTag('div', $this->options), // .modal
            Html::tag('div', '', ['class' => 'modal-background']),
            Html::beginTag('div', $this->contentOptions) // .modal-content
        ]);
    }

    protected function run(): string
    {
        if ($this->start === false) {
            throw new InvalidConfigException(
                'Unexpected ' . static::class . '::run() call. A matching start() is not found.'
            );
        }

        return implode("\n", [
            Html::endTag('div'), // .modal-content
            $this->renderCloseButton(),
            Html::endTag('div') // .modal
        ]);
    }

    private function renderCloseButton(): string
    {
        return Html::button('', $this->closeButtonOptions);
    }

    private function renderLaunchButton(): string
    {
        return Html::button($this->launchButtonLabel, $this->launchButtonOptions);
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

        $this->launchButtonOptions = $this->addOptions($this->launchButtonOptions, 'button');
        $this->launchButtonOptions['data-target'] = '#' . $this->options['id'];
        $this->launchButtonOptions['aria-haspopup'] = 'true';

        if ($this->launchButtonSize !== '') {
            Html::addCssClass($this->launchButtonOptions, $this->launchButtonSize);
        }

        if ($this->launchButtonColor !== '') {
            Html::addCssClass($this->launchButtonOptions, $this->launchButtonColor);
        }
    }

    public function launchButtonLabel(string $value): self
    {
        $new = clone $this;
        $new->launchButtonLabel = $value;

        return $new;
    }

    public function launchButtonOptions(array $value): self
    {
        $new = clone $this;
        $new->launchButtonOptions = $value;

        return $new;
    }

    public function launchButtonSize(string $value): self
    {
        if (!in_array($value, self::SIZE_ALL)) {
            $values = implode('"', self::SIZE_ALL);
            throw new InvalidArgumentException("Invalid size. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->launchButtonSize = $value;

        return $new;
    }

    public function launchButtonColor(string $value): self
    {
        if (!in_array($value, self::COLOR_ALL)) {
            $values = implode('"', self::COLOR_ALL);
            throw new InvalidArgumentException("Invalid color. Valid values are: \"$values\".");
        }

        $new = clone $this;
        $new->launchButtonColor = $value;

        return $new;
    }
}
