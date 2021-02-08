<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\ProgressBar;

final class ProgressBarTest extends TestCase
{
    public function testProgressBar(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()->render();

        $expected = <<<'HTML'
        <progress id="w1-progressbar" class="progress" max="100"></progress>
        HTML;

        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testProgressBarOptions(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()->withOptions(['class' => 'has-background-black'])->render();
        $expected = <<<'HTML'
        <progress id="w1-progressbar" class="progress has-background-black" max="100"></progress>
        HTML;

        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testProgressBarSize(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()->withSize(ProgressBar::SIZE_LARGE)->render();
        $expected = <<<'HTML'
        <progress id="w1-progressbar" class="progress is-large" max="100"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testProgressBarColor(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()->withColor(ProgressBar::COLOR_PRIMARY)->render();
        $expected = <<<'HTML'
        <progress id="w1-progressbar" class="progress is-primary" max="100"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testProgressBarMax(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()->withMaxValue(50)->render();
        $expected = <<<'HTML'
        <progress id="w1-progressbar" class="progress" max="50"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testProgressBarPercent(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()->withValue(75)->render();
        $expected = <<<'HTML'
        <progress id="w1-progressbar" class="progress" value="75" max="100">75%</progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testExceptionSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ProgressBar::widget()->withSize('is-non-existent')->render();
    }

    public function testExceptionColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ProgressBar::widget()->withColor('is-non-existent')->render();
    }
}
