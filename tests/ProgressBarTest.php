<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\ProgressBar;

final class ProgressBarTest extends TestCase
{
    public function testProgressBar(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress" max="100">0%</progress>
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
<progress id="w1-progressbar" class="progress has-background-black" max="100">0%</progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarSize(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->size('is-large')
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress is-large" max="100">0%</progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarColor(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->color('is-primary')
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress is-primary" max="100">0%</progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarMax(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->progressMax(50)
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress" max="50">0%</progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testProgressBarPercent(): void
    {
        ProgressBar::counter(0);

        $html = ProgressBar::widget()
            ->progressValue(75)
            ->render();

        $expectedHtml = <<<HTML
<progress id="w1-progressbar" class="progress" value="75" max="100">75%</progress>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
