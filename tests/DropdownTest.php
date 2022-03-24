<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Dropdown;

final class DropdownTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testButtonAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="is-link button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testButtonIconCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class="fas fa-angle-down"></i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testButtonIconTextAndAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-link"><i class>&#8593;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testButtonLabel(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Dropdown Label</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testButtonLabelAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span class="text-danger">Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testContentCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testDividerCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testId(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="id-test">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="id-test" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemActiveCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemDisabledStyleCss(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#" style="opacity:.65;">Dropdown item</a>
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemHeaderCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testMenuCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu-test">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testMissingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" option is required.');
        Dropdown::widget()->items([['url' => '#test']])->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     *
     *  @link https://bulma.io/documentation/components/dropdown/
     */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRenderItemsEncodeLabels(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRenderIconText(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRenderSubmenu(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
        <div class="dropdown-content">
        <a class="dropdown-item" href="#" style="opacity:.65;pointer-events:none;">Disable</a>
        <div class="dropdown">
        <div class="dropdown-trigger">
        <a class="dropdown-item">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </a>
        </div>
        <div id="w2-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testTriggerCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="dropdown">
        <div class="dropdown-trigger-test">
        <button class="button" aria-haspopup="true" aria-controls="w1-dropdown">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </button>
        </div>
        <div id="w1-dropdown" class="dropdown-menu">
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testUnClosedByContainer(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
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
