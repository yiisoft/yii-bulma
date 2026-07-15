<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\Dropdown;

final class DropdownTest extends TestCase
{
    public function testButtonAttributes(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="is-link button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->buttonAttributes(['class' => 'is-link'])
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testButtonIconCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class="fas fa-angle-down"></i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->buttonIconCssClass('fas fa-angle-down')
                ->buttonIconText('')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testButtonIconTextAndAttributes(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-link"><i class>&#8593;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->buttonIconAttributes(['class' => 'icon is-link'])
                ->buttonIconText('&#8593;')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testButtonLabel(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Dropdown Label</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->buttonLabel('Dropdown Label')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testButtonLabelAttributes(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span class="text-danger">Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->buttonLabelAttributes(['class' => 'text-danger'])
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testContentCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content-test">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->contentCssClass('dropdown-content-test')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testDividerCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <hr class="dropdown-divider-test">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->dividerCssClass('dropdown-divider-test')
                ->items([
                    '-',
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testId(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="id-test">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="id-test">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->id('id-test')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testImmutability(): void
    {
        $widget = Dropdown::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Dropdown::class));
        $this->assertNotSame($widget, $widget->buttonAttributes([]));
        $this->assertNotSame($widget, $widget->buttonIconAttributes([]));
        $this->assertNotSame($widget, $widget->buttonIconCssClass(''));
        $this->assertNotSame($widget, $widget->buttonIconText(''));
        $this->assertNotSame($widget, $widget->buttonLabel(''));
        $this->assertNotSame($widget, $widget->buttonLabelAttributes([]));
        $this->assertNotSame($widget, $widget->contentCssClass(''));
        $this->assertNotSame($widget, $widget->cssClass(''));
        $this->assertNotSame($widget, $widget->dividerCssClass(''));
        $this->assertNotSame($widget, $widget->enclosedByContainer(false));
        $this->assertNotSame($widget, $widget->id(Dropdown::class));
        $this->assertNotSame($widget, $widget->itemActiveCssClass(''));
        $this->assertNotSame($widget, $widget->itemCssClass(''));
        $this->assertNotSame($widget, $widget->itemDisabledStyleCss(''));
        $this->assertNotSame($widget, $widget->itemHeaderCssClass(''));
        $this->assertNotSame($widget, $widget->items([]));
        $this->assertNotSame($widget, $widget->menuCssClass(''));
        $this->assertNotSame($widget, $widget->submenu(false));
        $this->assertNotSame($widget, $widget->submenuAttributes([]));
        $this->assertNotSame($widget, $widget->triggerCssClass(''));
    }

    public function testItemActiveCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item active" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->itemActiveCssClass('active')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#', 'active' => true],
                ])
                ->render(),
        );
    }

    public function testItemCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item-test" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->itemCssClass('dropdown-item-test')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testItemDisabledStyleCss(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" style="opacity:.65;" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->itemDisabledStyleCss('opacity:.65;')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#', 'disable' => true],
                ])
                ->render(),
        );
    }

    public function testItemHeaderCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <h6 class="dropdown-header is-link">Dropdown header</h6>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->itemHeaderCssClass('dropdown-header is-link')
                ->items([
                    ['label' => 'Dropdown header'],
                ])
                ->render(),
        );
    }

    public function testMenuCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu-test" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->menuCssClass('dropdown-menu-test')
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testMissingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" option is required.');
        Dropdown::widget()
            ->items([['url' => '#test']])
            ->render();
    }

    /**
     *  @link https://bulma.io/documentation/components/dropdown/
     */
    public function testRender(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        <a class="dropdown-item" href="#">Other dropdown item</a>
        <a class="dropdown-item is-active" href="#">Active dropdown item</a>
        Other dropdown item
        <hr class="dropdown-divider">
        <a class="dropdown-item" href="#">With a divider</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                    ['label' => 'Other dropdown item', 'url' => '#'],
                    ['label' => 'Active dropdown item', 'url' => '#', 'active' => true],
                    ['label' => 'Other dropdown item', 'url' => '#', 'enclose' => false],
                    ['label' => '-'],
                    ['label' => 'With a divider', 'url' => '#'],
                ])
                ->render(),
        );
    }

    public function testRenderItemsEncodeLabels(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Encode &amp; Labels</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->items([
                    [
                        'label' => 'Encode & Labels',
                        'url' => '#',
                        'encode' => true,
                    ],
                ])
                ->render(),
        );
    }

    public function testRenderIconText(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#"><span><i class>&#8962; </i></span>Icon</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->items([
                    [
                        'label' => 'Icon',
                        'url' => '#',
                        'iconText' => '&#8962; ',
                        'iconAttribute' => 'icon',
                    ],
                ])
                ->render(),
        );
    }

    public function testRenderSubmenu(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" style="opacity:.65;pointer-events:none;" href="#">Disable</a>
        <div class="dropdown">
        <div class="dropdown-trigger">
        <a class="dropdown-item">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </a>
        </div>
        <div class="dropdown-menu" id="w2-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="/page2">Option 2</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->items([
                    [
                        'label' => 'Disable',
                        'url' => '#',
                        'disable' => true,
                    ],
                    [
                        'label' => 'Dropdown',
                        'items' => [
                            ['label' => 'Option 2', 'url' => '/page2'],
                        ],
                        'submenu' => true,
                    ],
                ])
                ->render(),
        );
    }

    public function testTriggerCssClass(): void
    {
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger-test">
        <button type="button" class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div class="dropdown-menu" id="w1-dropdown">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#">Dropdown item</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Dropdown::widget()
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->triggerCssClass('dropdown-trigger-test')
                ->render(),
        );
    }

    public function testUnClosedByContainer(): void
    {
        $this->assertSame(
            '<a class="dropdown-item" href="#">Dropdown item</a>',
            Dropdown::widget()
                ->items([
                    ['label' => 'Dropdown item', 'url' => '#'],
                ])
                ->enclosedByContainer()
                ->render(),
        );
    }
}
