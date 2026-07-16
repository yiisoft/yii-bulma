<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\ProgressBar;

final class ProgressBarTest extends TestCase
{
    public function testAttributes(): void
    {
        $expected = <<<HTML
        <progress class="has-background-black progress" id="w1-progressbar" max="100"></progress>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ProgressBar::widget()
                ->attributes(['class' => 'has-background-black'])
                ->render(),
        );
    }

    public function testColor(): void
    {
        $expected = <<<HTML
        <progress id="w1-progressbar" max="100" class="progress is-primary"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->color(ProgressBar::COLOR_PRIMARY)
            ->render());
    }

    public function testExceptionColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "is-primary", "is-link", "is-info", "is-success", "is-warning", "is-danger", "is-dark".',
        );
        ProgressBar::widget()
            ->color('is-non-existent')
            ->render();
    }

    public function testExceptionSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid size. Valid values are: "is-small", "is-medium", "is-large".');
        ProgressBar::widget()
            ->size('is-non-existent')
            ->render();
    }

    public function testImmutability(): void
    {
        $widget = ProgressBar::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(ProgressBar::class));
        $this->assertNotSame($widget, $widget->color('is-primary'));
        $this->assertNotSame($widget, $widget->id(ProgressBar::class));
        $this->assertNotSame($widget, $widget->maxValue(100));
        $this->assertNotSame($widget, $widget->size('is-small'));
        $this->assertNotSame($widget, $widget->value(100));
    }

    public function testMax(): void
    {
        $expected = <<<HTML
        <progress max="50" id="w1-progressbar" class="progress"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->maxValue(50)
            ->render());
    }

    public function testMaxException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid max value. It must be between 0 and 100.');
        ProgressBar::widget()
            ->maxValue(150)
            ->render();
    }

    public function testPercent(): void
    {
        $expected = <<<HTML
        <progress value="75" id="w1-progressbar" max="100" class="progress">75%</progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->value(75)
            ->render());
    }

    public function testSize(): void
    {
        $expected = <<<HTML
        <progress id="w1-progressbar" max="100" class="progress is-large"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->size(ProgressBar::SIZE_LARGE)
            ->render());
    }

    public function testRender(): void
    {
        $expected = <<<HTML
        <progress id="w1-progressbar" max="100" class="progress"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()->render());
    }

    public function testValueExceptionWithLessThanZero(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value. It must be between 0 and 100.');
        ProgressBar::widget()
            ->value(-1)
            ->render();
    }

    public function testValueExceptionWithGreaterZero(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value. It must be between 0 and 100.');
        ProgressBar::widget()
            ->value(150)
            ->render();
    }

    public function testWithZeroValues(): void
    {
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->value(0)
            ->maxValue(0)
            ->render());
    }

    public function testWithNullValues(): void
    {
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->value(null)
            ->maxValue(null)
            ->render());
    }
}
