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
            ->buttonLabel('Russian cities')
            ->items([
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
            ->buttonLabel('Russian cities')
            ->buttonLabelOptions(['class' => 'is-italic'])
            ->items([
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
            ->buttonLabel('Russian cities')
            ->items([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->options(['class' => 'is-active'])
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
            ->buttonLabel('Russian cities')
            ->buttonOptions(['class' => 'is-primary'])
            ->items([
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
            ->buttonLabel('Russian cities')
            ->items([
                ['label' => 'San petesburgo', 'url' => '#'],
                ['label' => 'Moscu', 'url' => '#'],
                ['label' => 'Novosibirsk', 'url' => '#'],
                '-',
                ['label' => 'Ekaterinburgo', 'url' => '#'],
            ])
            ->triggerOptions(['class' => 'testeMe'])
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
            ->buttonLabel('Russian cities')
            ->items([
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
            ->buttonLabel('Russian cities')
            ->items([
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

    public function testImmutability(): void
    {
        $widget = Dropdown::widget();

        $this->assertNotSame($widget, $widget->buttonLabel(''));
        $this->assertNotSame($widget, $widget->buttonLabelOptions([]));
        $this->assertNotSame($widget, $widget->dividerClass(''));
        $this->assertNotSame($widget, $widget->itemClass(''));
        $this->assertNotSame($widget, $widget->itemsClass(''));
        $this->assertNotSame($widget, $widget->withoutEncodeLabels());
        $this->assertNotSame($widget, $widget->withoutEncloseByContainer());
        $this->assertNotSame($widget, $widget->items([]));
        $this->assertNotSame($widget, $widget->options([]));
        $this->assertNotSame($widget, $widget->buttonOptions([]));
        $this->assertNotSame($widget, $widget->itemsOptions([]));
        $this->assertNotSame($widget, $widget->triggerOptions([]));
        $this->assertNotSame($widget, $widget->id(Dropdown::class));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Dropdown::class));
    }
}
