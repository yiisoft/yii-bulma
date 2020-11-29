<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\ModalCard;

final class ModalCardTest extends TestCase
{
    public function testModalCard(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin();

        $html = $widget->start();
        $html .= 'Say hello...';
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testFooterOptions(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->footerOptions([
                'class' => 'bg-transparent',
            ]);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testContentOptions(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->contentOptions([
                'class' => 'bg-white',
            ]);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonLabel(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->toggleButtonLabel('Launch modal');

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonOptions(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->toggleButtonOptions([
                'disabled' => true,
            ]);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonSize(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->toggleButtonSize(ModalCard::SIZE_LARGE);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonColor(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->toggleButtonColor(ModalCard::COLOR_PRIMARY);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testToggleButtonEnabled(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->toggleButtonEnabled(false);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML

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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCloseButtonSize(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->closeButtonSize(ModalCard::SIZE_LARGE);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCloseButtonOptions(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->closeButtonOptions([
                'disabled' => true
            ]);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCloseButtonEnabled(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->closeButtonEnabled(false);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testHeaderOptions(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->headerOptions([
                'class' => 'bg-info',
            ]);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testFooter(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->footer('Some text');

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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
<footer class="modal-card-foot">
Some text</footer>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testTitle(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->title('Some title');

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testBodyOptions(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->bodyOptions([
                'class' => 'bg-white'
            ]);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testTitleOptions(): void
    {
        ModalCard::counter(0);

        $widget = ModalCard::begin()
            ->titleOptions([
                'class' => 'text-info'
            ]);

        $html = $widget->start();
        $html .= $widget->end();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
