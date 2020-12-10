<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\Modal;

final class ModalTest extends TestCase
{
    public function testModal(): void
    {
        Modal::counter(0);

        $html = Modal::widget()
            ->toggleButtonEnabled(false)
            ->closeButtonEnabled(false)
            ->begin();
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

        $html = Modal::widget()
            ->toggleButtonEnabled(false)
            ->closeButtonEnabled(false)
            ->options(['class' => 'widescreen'])
            ->begin();
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

        $html = Modal::widget()
            ->closeButtonEnabled(false)
            ->begin();
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

        $html = Modal::widget()
            ->toggleButtonLabel('Click to open.')
            ->begin();
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

        $html = Modal::widget()
            ->toggleButtonColor(Modal::COLOR_INFO)
            ->begin();
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

        $html = Modal::widget()
            ->toggleButtonSize(Modal::SIZE_LARGE)
            ->begin();
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

        $html = Modal::widget()
            ->toggleButtonEnabled(false)
            ->begin();
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

        $html = Modal::widget()
            ->closeButtonSize(Modal::SIZE_LARGE)
            ->begin();
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

        $html = Modal::widget()
            ->closeButtonOptions(['class' => 'some-class'])
            ->begin();
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

        $html = Modal::widget()
            ->contentOptions(['class' => 'some-class'])
            ->begin();
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

    public function testExceptionToggleButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Modal::widget()->toggleButtonSize('is-non-existent');
    }

    public function testExceptionToggleButtonColor(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Modal::widget()->toggleButtonColor('is-non-existent');
    }

    public function testExceptionToggleCloseButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Modal::widget()->closeButtonSize('is-non-existent');
    }

    public function testToggleButtonOptions(): void
    {
        Modal::counter(0);

        $html = Modal::widget()
            ->closeButtonEnabled(false)
            ->toggleButtonOptions(['class' => 'testMe'])
            ->begin();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button testMe" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>

<div class="modal-content">
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
