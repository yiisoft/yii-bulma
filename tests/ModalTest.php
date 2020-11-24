<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\Modal;

final class ModalTest extends TestCase
{
    public function testModal(): void
    {
        Modal::counter(0);

        $html = Modal::begin()->start();
        $html .= Modal::end();

        $expectedHtml = <<<HTML
<button type="button" class="button" data-target="#w1-modal" aria-haspopup="true">Launch modal</button>
<div id="w1-modal" class="modal">
<div class="modal-background"></div>
<div class="modal-content"></div>
<button type="button" class="modal-close" aria-label="close"></button>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
