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

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress" max="100"></progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarOptions(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->options([
                'class' => 'has-background-black',
            ])
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress has-background-black" max="100"></progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarSize(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->size(ProgressBar::SIZE_LARGE)
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress is-large" max="100"></progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarColor(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->color(ProgressBar::COLOR_PRIMARY)
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress is-primary" max="100"></progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarMax(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->maxValue(50)
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress" max="50"></progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarPercent(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->value(75)
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress" value="75" max="100">75%</progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testExceptionSize(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ProgressBar::widget()->size('is-non-existent')->render();
    }

    public function testExceptionColor(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ProgressBar::widget()->color('is-non-existent')->render();
    }
}
