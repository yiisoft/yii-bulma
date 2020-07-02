<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Widget\Exception\InvalidConfigException;
use Yiisoft\Yii\Bulma\Dropdown;

final class DropdownTest extends TestCase
{
    public function testDropdown()
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->buttonLabel('Russian cities')
            ->items([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();

        $expected = <<<HTML
<div id="w1-dropdown" class="dropdown is-hoverable">
<div class="dropdown-trigger">
<button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
<span>Dropdown label</span>
<span class="icon is-small">
<i class="fas fa-angle-down" aria-hidden="true"></i>
</span>
</button>
</div>
<div class="dropdown-menu">
<a class="dropdown-item" href="/about">About</a>
</div>
</div>
HTML;

        var_dump($html);
        die;

        $this->assertEqualsWithoutLE($expected, $html);
    }
}
