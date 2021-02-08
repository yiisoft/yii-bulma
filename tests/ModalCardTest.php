<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\ModalCard;

final class ModalCardTest extends TestCase
{
    public function testModalCard(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->begin();
        $html .= 'Say hello...';
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        Say hello...</section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testFooterOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withFooterOptions(['class' => 'bg-transparent'])->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot bg-transparent"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testContentOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withContentOptions(['class' => 'bg-white'])->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card bg-white">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testToggleButtonLabel(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withToggleButtonLabel('Launch modal')->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Launch modal</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testToggleButtonOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withToggleButtonOptions(['disabled' => true])->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" disabled data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testToggleButtonSize(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withToggleButtonSize(ModalCard::SIZE_LARGE)->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button is-large" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testToggleButtonColor(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withToggleButtonColor(ModalCard::COLOR_PRIMARY)->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button is-primary" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testToggleButtonEnabled(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withoutToggleButton()->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'

        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testCloseButtonSize(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withCloseButtonSize(ModalCard::SIZE_LARGE)->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete is-large" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testCloseButtonOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withCloseButtonOptions(['disabled' => true])->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" disabled aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testCloseButtonEnabled(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withoutCloseButton()->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>

        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testHeaderOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withHeaderOptions(['class' => 'bg-info'])->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head bg-info">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testFooter(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withFooter('Some text')->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot">Some text</footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testTitle(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withTitle('Some title')->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Some title</p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBodyOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withBodyOptions(['class' => 'bg-white'])->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body bg-white">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testTitleOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withTitleOptions(['class' => 'text-info'])->begin();
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title text-info"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        </section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testExceptionToggleButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ModalCard::widget()->withToggleButtonSize('is-non-existent')->begin();
    }

    public function testExceptionToggleButtonColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ModalCard::widget()->withToggleButtonColor('is-non-existent')->begin();
    }

    public function testExceptionToggleCloseButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ModalCard::widget()->withCloseButtonSize('is-non-existent')->begin();
    }

    public function testModalCardOptions(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::widget()->withOptions(['class' => 'testMe'])->begin();
        $html .= 'Say hello...';
        $html .= ModalCard::end();
        $expected = <<<'HTML'
        <button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal testMe">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button type="button" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        Say hello...</section>
        <footer class="modal-card-foot"></footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
