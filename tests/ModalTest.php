<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\Modal;

final class ModalTest extends TestCase
{
    public function testModal(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->toggleButtonEnabled(false)
            ->closeButtonEnabled(false)
            ->start();
        $html .= 'Say hello...';
        $html .= Modal::end();

        $expectedHtml = <<<HTML

<div id="w1-modal" class="modal">
<div class="modal-background"></div>

<div class="modal-content">
Say hello...</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testOptions(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->toggleButtonEnabled(false)
            ->closeButtonEnabled(false)
            ->options(['class' => 'widescreen'])
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML

<div id="w1-modal" class="modal widescreen">
<div class="modal-background"></div>

<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonEnabled(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->closeButtonEnabled(false)
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>

<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonLabel(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->toggleButtonLabel('Click to open.')
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Click to open.</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<button type="button" class="modal-close" aria-label="close"></button>
<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonColor(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->toggleButtonColor(Modal::COLOR_INFO)
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button is-info" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<button type="button" class="modal-close" aria-label="close"></button>
<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonSize(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->toggleButtonSize(Modal::SIZE_LARGE)
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button is-large" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<button type="button" class="modal-close" aria-label="close"></button>
<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCloseButtonEnabled(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->toggleButtonEnabled(false)
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML

<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<button type="button" class="modal-close" aria-label="close"></button>
<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCloseButtonSize(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->closeButtonSize(Modal::SIZE_LARGE)
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<button type="button" class="modal-close is-large" aria-label="close"></button>
<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCloseButtonOptions(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->closeButtonOptions(['class' => 'some-class'])
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<button type="button" class="modal-close some-class" aria-label="close"></button>
<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testContentOptions(): void
    {
        Modal::counter(0);

        $html = Modal::begin()
            ->contentOptions(['class' => 'some-class'])
            ->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<button type="button" class="modal-close" aria-label="close"></button>
<div class="modal-content some-class">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testException()
    {
        $this->expectException(\InvalidArgumentException::class);

        Modal::widget()->toggleButtonSize('is-non-existent');
        Modal::widget()->toggleButtonColor('is-non-existent');
        Modal::widget()->closeButtonSize('is-non-existent');
    }
}
