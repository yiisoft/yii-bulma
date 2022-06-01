<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Img;
use Yiisoft\Yii\Bulma\Nav;

final class NavTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testDeepActivateParents(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Dropdown</a>
        <div class="navbar-dropdown">
        <div class="dropdown">
        <div class="dropdown-trigger">
        <a class="navbar-item">
        <span>Click Me</span>
        <span class="icon is-small"><i class>&#8595;</i></span>
        </a>
        </div>
        <div id="w2-dropdown" class="dropdown-menu">
        <div class="dropdown-content">
        <a class="navbar-item is-active" href="#">Page</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->activateParents()
                ->items([
                    [
                        'label' => 'Dropdown',
                        'items' => [
                            [
                                'label' => 'Sub Dropdown',
                                'items' => [
                                    ['label' => 'Page', 'url' => '#', 'active' => true],
                                ],
                                'submenu' => true,
                            ],
                        ],
                    ],
                ])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testDropdown(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Docs</a>
        <div class="navbar-dropdown">
        <a class="navbar-item" href="#">Overview</a>
        <a class="navbar-item" href="#">Elements</a>
        <hr class="navbar-divider">
        <a class="navbar-item" href="#">Components</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([
                    [
                        'label' => 'Docs',
                        'items' => [
                            ['label' => 'Overview', 'url' => '#'],
                            ['label' => 'Elements', 'url' => '#'],
                            '-',
                            ['label' => 'Components', 'url' => '#'],
                        ],
                    ],
                ])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testDropdownWithDropdownAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">Page1</a>
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Dropdown1</a>
        <div id="test1" class="is-link navbar-dropdown" data-id="t1">
        <a class="navbar-item" href="#">Page2</a>
        <a class="navbar-item" href="#">Page3</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([
                    [
                        'label' => 'Page1',
                        'url' => '#',
                    ],
                    [
                        'label' => 'Dropdown1',
                        'dropdownAttributes' => ['class' => 'is-link', 'data-id' => 't1', 'id' => 'test1'],
                        'items' => [
                            ['label' => 'Page2', 'url' => '#'],
                            ['label' => 'Page3', 'url' => '#'],
                        ],
                        'visible' => true,
                    ],
                    [
                        'label' => 'Dropdown2',
                        'items' => [
                            ['label' => 'Page4', 'url' => '#'],
                            ['label' => 'Page5', 'url' => '#'],
                        ],
                        'visible' => false,
                    ],
                ])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testEnclosedByEndMenu(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <div class="navbar-end">
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Docs</a>
        <div class="navbar-dropdown">
        <a class="navbar-item" href="#">Overview</a>
        <a class="navbar-item" href="#">Elements</a>
        <hr class="navbar-divider">
        <a class="navbar-item" href="#">Components</a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->enclosedByEndMenu()
                ->items([
                    [
                        'label' => 'Docs',
                        'items' => [
                            ['label' => 'Overview', 'url' => '#'],
                            ['label' => 'Elements', 'url' => '#'],
                            '-',
                            ['label' => 'Components', 'url' => '#'],
                        ],
                    ],
                ])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testEnclosedByStartMenu(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <div class="navbar-start">
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Docs</a>
        <div class="navbar-dropdown">
        <a class="navbar-item" href="#">Overview</a>
        <a class="navbar-item" href="#">Elements</a>
        <hr class="navbar-divider">
        <a class="navbar-item" href="#">Components</a>
        </div>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->enclosedByStartMenu()
                ->items([
                    [
                        'label' => 'Docs',
                        'items' => [
                            ['label' => 'Overview', 'url' => '#'],
                            ['label' => 'Elements', 'url' => '#'],
                            '-',
                            ['label' => 'Components', 'url' => '#'],
                        ],
                    ],
                ])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testEncodeLabels(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">a &amp; b</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([['label' => 'a & b', 'encode' => true]])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExplicitActive(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">Item1</a>
        <a class="navbar-item" href="/site/index">Item2</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([['label' => 'Item1', 'active' => true], ['label' => 'Item2', 'url' => '/site/index']])
                ->withoutActivateItems()
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExplicitActiveSubItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">Item1</a>
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Item2</a>
        <div class="navbar-dropdown">
        <a class="navbar-item" href="site/index">Page2</a>
        <a class="navbar-item is-active" href="#">Page3</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->currentPath('/site/index')
                ->items([
                    [
                        'label' => 'Item1',
                    ],
                    [
                        'label' => 'Item2',
                        'items' => [
                            ['label' => 'Page2', 'url' => '#', 'url' => 'site/index'],
                            ['label' => 'Page3', 'url' => '#', 'active' => true],
                        ],
                    ],
                ])
                ->withoutActivateItems()
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testIcon(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="/setting/account"><span class="icon"><i class="fas fa-user-cog"></i></span>Setting Account</a>
        <a class="navbar-item" href="/profile"><span class="icon"><i class="fas fa-users"></i></span>Profile</a>
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Admin<img class="img-rounded" src="../../docs/images/icon-avatar.png" aria-expanded="false"></a>
        <div class="navbar-dropdown">
        <a class="navbar-item" href="/auth/logout">Logout</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([
                    [
                        'label' => 'Setting Account',
                        'url' => '/setting/account',
                        'iconCssClass' => 'fas fa-user-cog',
                        'iconAttributes' => ['class' => 'icon'],
                    ],
                    [
                        'label' => 'Profile',
                        'url' => '/profile',
                        'iconCssClass' => 'fas fa-users',
                        'iconAttributes' => ['class' => 'icon'],
                    ],
                    [
                        'label' => 'Admin' . Img::tag()
                                ->attributes(['class' => 'img-rounded', 'aria-expanded' => 'false'])
                                ->url('../../docs/images/icon-avatar.png'),
                        'items' => [
                            ['label' => 'Logout', 'url' => '/auth/logout'],
                        ],
                        'encode' => false,
                    ],
                ])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImplicitActive(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="is-active navbar-item" href="#">Item1</a>
        <a class="is-active navbar-item" href="/site/index">Item2</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->currentPath('/site/index')
                ->items([['label' => 'Item1', 'active' => true], ['label' => 'Item2', 'url' => '/site/index']])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImplicitActiveSubItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">Item1</a>
        <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="#">Item2</a>
        <div class="navbar-dropdown">
        <a class="navbar-item" href="/site/page2">Page2</a>
        <a class="navbar-item is-active" href="/site/page3">Page3</a>
        </div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([
                    [
                        'label' => 'Item1',
                    ],
                    [
                        'label' => 'Item2',
                        'items' => [
                            ['label' => 'Page2', 'content' => 'Page2', 'url' => '/site/page2'],
                            ['label' => 'Page3', 'content' => 'Page3', 'url' => '/site/page3', 'active' => true],
                        ],
                    ],
                ])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImmutability(): void
    {
        $widget = Nav::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->activateParents());
        $this->assertNotSame($widget, $widget->currentPath(''));
        $this->assertNotSame($widget, $widget->enclosedByEndMenu());
        $this->assertNotSame($widget, $widget->enclosedByStartMenu());
        $this->assertNotSame($widget, $widget->items([]));
        $this->assertNotSame($widget, $widget->withoutActivateItems());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testMissingLabel(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" option is required.');
        Nav::widget()
            ->items([['content' => 'Page1']])
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">Page1</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([['label' => 'Page1', 'url' => '#']])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRenderItemsDisabled(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#" style="opacity:.65; pointer-events:none;">a & b</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([['label' => 'a & b', 'disabled' => true]])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRenderItemsEmpty(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">Page1</a>
        <a class="navbar-item" href="#">Page4</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Nav::widget()
                ->items([['label' => 'Page1', 'items' => null], ['label' => 'Page4', 'items' => []]])
                ->render()
        );

        $this->assertEmpty(Nav::widget()
            ->items([])
            ->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRenderItemsWithoutUrl(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div class="navbar-menu">
        <a class="navbar-item" href="#">Page1</a>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Nav::widget()
            ->items([['label' => 'Page1']])
            ->render());
    }
}
