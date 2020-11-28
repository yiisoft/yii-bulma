<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\ModalCard;

final class ModalCardTest extends TestCase
{
    public function testModalCard(): void
    {
        ModalCard::counter(0);

        $html = ModalCard::begin()->start();
        $html .= 'Say hello...';
        $html .= ModalCard::end();

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

        $html = ModalCard::begin()
            ->footerOptions(['class' => 'bg-transparent'])
            ->start();
        $html .= ModalCard::end();

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
}
