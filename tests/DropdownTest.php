<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\Dropdown;

final class DropdownTest extends TestCase
{
    public function testDropdown(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->withButtonLabel('Russian cities')
            ->withItems([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-dropdown" class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
        <span>Russian cities</span>
        <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
        </div>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#">San petesburgo</a>
        <a class="dropdown-item" href="#">Moscu</a>
        <a class="dropdown-item" href="#">Novosibirsk</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Ekaterinburgo</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testDropdownButtonLabelOptions(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->withButtonLabel('Russian cities')
            ->withButtonLabelOptions(['class' => 'is-italic'])
            ->withItems([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-dropdown" class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
        <span class="is-italic">Russian cities</span>
        <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
        </div>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#">San petesburgo</a>
        <a class="dropdown-item" href="#">Moscu</a>
        <a class="dropdown-item" href="#">Novosibirsk</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Ekaterinburgo</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testDropdownOptions(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->withButtonLabel('Russian cities')
            ->withItems([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->withOptions(['class' => 'is-active'])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-dropdown" class="dropdown is-active">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
        <span>Russian cities</span>
        <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
        </div>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#">San petesburgo</a>
        <a class="dropdown-item" href="#">Moscu</a>
        <a class="dropdown-item" href="#">Novosibirsk</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Ekaterinburgo</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testDropdownButtonOptions(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->withButtonLabel('Russian cities')
            ->withButtonOptions(['class' => 'is-primary'])
            ->withItems([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-dropdown" class="dropdown">
        <div class="dropdown-trigger">
        <button class="button is-primary" aria-haspopup="true" aria-controls="dropdown-menu">
        <span>Russian cities</span>
        <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
        </div>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#">San petesburgo</a>
        <a class="dropdown-item" href="#">Moscu</a>
        <a class="dropdown-item" href="#">Novosibirsk</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Ekaterinburgo</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testDropdownTriggerOptions(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->withButtonLabel('Russian cities')
            ->withItems([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->withTriggerOptions(['class' => 'testeMe'])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-dropdown" class="dropdown">
        <div class="dropdown-trigger testeMe">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
        <span>Russian cities</span>
        <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
        </div>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#">San petesburgo</a>
        <a class="dropdown-item" href="#">Moscu</a>
        <a class="dropdown-item" href="#">Novosibirsk</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Ekaterinburgo</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testDropdownWithIcon(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->withButtonLabel('Russian cities')
            ->withItems([
                ['label' => 'San petesburgo', 'url' => '#', 'icon' => 'testIcon', 'iconOptions' => ['class' => 'icon']],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#', 'icon' => 'testIcon', 'iconOptions' => ['class' => 'icon']],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-dropdown" class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
        <span>Russian cities</span>
        <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
        </div>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#"><span class="icon"><i class="testIcon"></i></span><span>San petesburgo</span></a>
        <a class="dropdown-item" href="#">Moscu</a>
        <a class="dropdown-item" href="#">Novosibirsk</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"><span class="icon"><i class="testIcon"></i></span><span>Ekaterinburgo</span></a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testEncodeLabels(): void
    {
        Dropdown::counter(0);

        $html = Dropdown::widget()
            ->withButtonLabel('Russian cities')
            ->withItems([
                ['label' => '<span><i class=fas fas-home></i>San petesburgo</span>', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-dropdown" class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
        <span>Russian cities</span>
        <span class="icon is-small">
        <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
        </div>
        <div class="dropdown-menu">
        <a class="dropdown-item" href="#">&lt;span&gt;&lt;i class=fas fas-home&gt;&lt;/i&gt;San petesburgo&lt;/span&gt;</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Ekaterinburgo</a>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
