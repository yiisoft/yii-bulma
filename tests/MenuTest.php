<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Menu;

final class MenuTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testActiveItemClosure(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <li><a href="#" class="is-active">item1</a></li>
        <p class="menu-label">item2</p>

        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->urlTemplate('')
                ->labelTemplate('')
                ->items([
                    [
                        'label' => 'item1',
                        'url' => '#',
                        'labelTemplate' => '{label}',
                        'urlTemplate' => '<a href={url}>{icon}{label}</a>',
                        'active' => function ($item, $hasActiveChild, $isItemActive, $widget) {
                            return isset($item, $hasActiveChild, $isItemActive, $widget);
                        },
                    ],
                    [
                        'label' => 'item2',
                        'labelTemplate' => '{label}',
                        'active' => false,
                    ],
                ])
            ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testActivateItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a><ul class = menu-list>
        <li><a href="user/update">Update</a></li>
        <li class="testMe"><a href="user/block">Block</a></li>
        </ul></li>
        <li class="testMe"><a href="user/export">Export</a></li>
        </ul>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->currentPath('user/block')
                ->deactivateItems()
                ->items([
                    [
                        'label' => 'Users',
                        'items' => [
                            [
                                'label' => 'Manager',
                                'url' => 'user/index',
                                'items' => [
                                    ['label' => 'Update', 'url' => 'user/update'],
                                    ['label' => 'Block', 'url' => 'user/block'],
                                ],
                            ],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                ])
            ->lastItemCssClass('testMe')
            ->render()
        );

        $expected = <<<HTML
        <aside id="w2-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a><ul class = menu-list>
        <li><a href="user/update">Update</a></li>
        <li class="testMe"><a href="user/block" class="is-active">Block</a></li>
        </ul></li>
        <li class="testMe"><a href="user/export">Export</a></li>
        </ul>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->currentPath('user/block')
                ->items([
                    [
                        'label' => 'Users',
                        'items' => [
                            [
                                'label' => 'Manager',
                                'url' => 'user/index',
                                'items' => [
                                    ['label' => 'Update', 'url' => 'user/update'],
                                    ['label' => 'Block', 'url' => 'user/block'],
                                ],
                            ],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                ])
                ->lastItemCssClass('testMe')
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testActivateParentItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index" class="is-active">Manager</a><ul class = menu-list>
        <li><a href="user/update">Update</a></li>
        <li class="testMe"><a href="user/block" class="is-active">Block</a></li>
        </ul></li>
        <li class="testMe"><a href="user/export">Export</a></li>
        </ul>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->activateParents()
                ->currentPath('user/block')
                ->items([
                    [
                        'label' => 'Users',
                        'items' => [
                            [
                                'label' => 'Manager',
                                'url' => 'user/index',
                                'items' => [
                                    ['label' => 'Update', 'url' => 'user/update'],
                                    ['label' => 'Block', 'url' => 'user/block'],
                                ],
                            ],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                ])
                ->lastItemCssClass('testMe')
            ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testBrand(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <div class=aside-tools>
        <div class=aside-tools-label>
        <span><b>Brand</b> Example</span>
        </div>
        </div>
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a></li>
        <li class="testMe"><a href="user/export">Export</a></li>
        </ul>
        <li><a href="/setting" class="is-active">Setting</a></li>
        <li class="testMe"><a href="/profile">Profile</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->brand(
                    '<div class=aside-tools>' . "\n" . '<div class=aside-tools-label>' . "\n" .
                    '<span><b>Brand</b> Example</span>' . "\n" . '</div>' . "\n" . '</div>'
                )
                ->currentPath('/setting')
                ->items([
                    ['label' => 'Users',
                        'items' => [
                            ['label' => 'Manager', 'url' => 'user/index'],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                    [
                        'label' => 'Setting',
                        'url' => '/setting',
                    ],
                    [
                        'label' => 'Profile',
                        'url' => '/profile',
                    ],
                ])
                ->lastItemCssClass('testMe')
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testCurrentPath(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <li><a href="/setting" class="is-active">Setting</a></li>
        <li><a href="/profile">Profile</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->currentPath('/setting')
                ->items([
                    [
                        'label' => 'Setting',
                        'url' => '/setting',
                    ],
                    [
                        'label' => 'Profile',
                        'url' => '/profile',
                    ],
                ])
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testFirstItemCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li class="testMe"><a href="user/index">Manager</a></li>
        <li><a href="user/export">Export</a></li>
        </ul>
        <li><a href="/setting" class="is-active">Setting</a></li>
        <li><a href="/profile">Profile</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->currentPath('/setting')
                ->firstItemCssClass('testMe')
                ->items([
                    ['label' => 'Users',
                        'items' => [
                            ['label' => 'Manager', 'url' => 'user/index'],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                    [
                        'label' => 'Setting',
                        'url' => '/setting',
                    ],
                    [
                        'label' => 'Profile',
                        'url' => '/profile',
                    ],
                ])
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHiddenItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a></li>
        <li class="testMe"><a href="user/export">Export</a></li>
        </ul>
        <li class="testMe"><a href="/setting" class="is-active">Setting</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->currentPath('/setting')
                ->items([
                    [
                        'label' => 'Users',
                        'items' => [
                            ['label' => 'Manager', 'url' => 'user/index'],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                    [
                        'label' => 'Setting',
                        'url' => '/setting',
                    ],
                    [
                        'label' => 'Profile',
                        'items' => [],
                    ],
                ])
                ->hiddenEmptyItems()
                ->lastItemCssClass('testMe')
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImmutability(): void
    {
        $widget = Menu::widget();

        $this->assertNotSame($widget, $widget->activateParents());
        $this->assertNotSame($widget, $widget->activeCssClass(''));
        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Menu::class));
        $this->assertNotSame($widget, $widget->brand(''));
        $this->assertNotSame($widget, $widget->currentPath(''));
        $this->assertNotSame($widget, $widget->deactivateItems());
        $this->assertNotSame($widget, $widget->firstItemCssClass(''));
        $this->assertNotSame($widget, $widget->id(Menu::class));
        $this->assertNotSame($widget, $widget->itemAttributes([]));
        $this->assertNotSame($widget, $widget->items([]));
        $this->assertNotSame($widget, $widget->labelTemplate(''));
        $this->assertNotSame($widget, $widget->lastItemCssClass(''));
        $this->assertNotSame($widget, $widget->urlTemplate(''));
        $this->assertNotSame($widget, $widget->subMenuTemplate(''));
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">General</p>
        <ul class = menu-list>
        <li><a href="site/index" class="testMe"><span class="icon"><i class="mdi mdi-desktop-mac"></i></span>Dashboard</a></li>
        <li><a href="site/logout" class="testMe"><span class="icon"><i class="mdi mdi-logout"></i></span>Logout</a></li>
        </ul>
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a></li>
        <li><a href="user/export">Export</a></li>
        </ul>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->items([
                    ['label' => 'General',
                        'items' => [
                            [
                                'label' => 'Dashboard',
                                'url' => 'site/index',
                                'icon' => 'mdi mdi-desktop-mac',
                                'iconAttributes' => ['class' => 'icon'],
                                'linkAttributes' => ['class' => 'testMe'],
                            ],
                            [
                                'label' => 'Logout',
                                'url' => 'site/logout',
                                'icon' => 'mdi mdi-logout',
                                'iconAttributes' => ['class' => 'icon'],
                                'linkAttributes' => ['class' => 'testMe'],
                            ],
                        ],
                    ],
                    ['label' => 'Users',
                        'items' => [
                            ['label' => 'Manager', 'url' => 'user/index'],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                ])
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsClassAsArray(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <li class="someclass"><a href="#" class="item-active">item1</a></li>
        <li class="another-class other--class two classes"><a href="#">item2</a></li>
        <li><a href="#">item3</a></li>
        <li class="some-other-class foo_bar_baz_class"><a href="#">item4</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->activeCssClass('item-active')
                ->items([
                    [
                        'label' => 'item1',
                        'url' => '#',
                        'active' => true,
                        'itemAttributes' => ['class' => ['someclass']],
                    ],
                    [
                        'label' => 'item2',
                        'url' => '#',
                        'itemAttributes' => ['class' => ['another-class', 'other--class', 'two classes']],
                    ],
                    [
                        'label' => 'item3',
                        'url' => '#',
                    ],
                    [
                        'label' => 'item4',
                        'url' => '#',
                        'itemAttributes' => ['class' => ['some-other-class', 'foo_bar_baz_class']],
                    ],
                ])
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsClassAsString(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <li class="someclass"><a href="#">item1</a></li>
        <li><a href="#">item2</a></li>
        <li class="some classes"><a href="#">item3</a></li>
        <li class="another-class other--class two classes"><a href="#" class="item-active">item4</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->activeCssClass('item-active')
                ->items([
                    [
                        'label' => 'item1',
                        'url' => '#',
                        'itemAttributes' => ['class' => 'someclass'],
                    ],
                    [
                        'label' => 'item2',
                        'url' => '#',
                    ],
                    [
                        'label' => 'item3',
                        'url' => '#',
                        'itemAttributes' => ['class' => 'some classes'],
                    ],
                    [
                        'label' => 'item4',
                        'url' => '#',
                        'active' => true,
                        'itemAttributes' => ['class' => 'another-class other--class two classes'],
                    ],
                ])
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsEmpty(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $html = Menu::widget()->items([])->render();
        $this->assertEmpty($html);
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsEmptyLabel(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <li><a href="#"></a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, Menu::widget()->items([['url' => '#']])->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsTag(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <div><a href="#">item1</a></div>
        <a href="#">item2</a>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->items([
                    [
                        'label' => 'item1',
                        'url' => '#',
                        'tag' => 'div',
                    ],
                    [
                        'label' => 'item2',
                        'url' => '#',
                        'tag' => null,
                    ],
                ])
                ->render()
        );

        $expected = <<<HTML
        <aside id="w2-menu" class="menu">
        <ul class="menu-list">
        <a href="#">item1</a>
        <a href="#">item2</a>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->items([
                    [
                        'label' => 'item1',
                        'url' => '#',
                    ],
                    [
                        'label' => 'item2',
                        'url' => '#',
                    ],
                ])
                ->itemsTag(null)
                ->render()
        );

        $expected = <<<HTML
        <aside id="w3-menu" class="menu">
        <ul class="menu-list">
        <a href="#">item1</a>
        <div><a href="#">item2</a></div>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->items([
                    [
                        'label' => 'item1',
                        'url' => '#',
                    ],
                    [
                        'label' => 'item2',
                        'url' => '#',
                        'tag' => 'div',
                    ],
                ])
                ->itemsTag(null)
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsTemplate(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <li><a href="#">item1</a></li>
        <p class="menu-label">item2</p>

        item3 (no template)
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->labelTemplate('')
                ->urlTemplate('')
                ->items([
                    [
                        'label' => 'item1',
                        'url' => '#',
                        'labelTemplate' => '{label}',
                        'urlTemplate' => '<a href={url}>{icon}{label}</a>',
                    ],
                    [
                        'label' => 'item2',
                        'labelTemplate' => '{label}',
                    ],
                    [
                        'label' => 'item3 (no template)',
                    ],
                ])
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsVisible(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">General</p>
        <ul class = menu-list>
        <li><a href="site/index"><span class="icon"><i class="mdi mdi-desktop-mac"></i></span>Dashboard</a></li>
        </ul>
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a></li>
        <li><a href="user/export">Export</a></li>
        </ul>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->items([
                    ['label' => 'General',
                        'items' => [
                            [
                                'label' => 'Dashboard',
                                'url' => 'site/index',
                                'icon' => 'mdi mdi-desktop-mac',
                                'iconAttributes' => ['class' => 'icon'],
                            ],
                        ],
                    ],
                    ['label' => 'Users',
                        'items' => [
                            ['label' => 'Manager', 'url' => 'user/index'],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                    [
                        'label' => 'Logout',
                        'url' => 'site/logout',
                        'visible' => false,
                    ],
                ])
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testLastItemCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a></li>
        <li class="testMe"><a href="user/export">Export</a></li>
        </ul>
        <li><a href="/setting" class="is-active">Setting</a></li>
        <li class="testMe"><a href="/profile">Profile</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->currentPath('/setting')
                ->items([
                    ['label' => 'Users',
                        'items' => [
                            ['label' => 'Manager', 'url' => 'user/index'],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                    [
                        'label' => 'Setting',
                        'url' => '/setting',
                    ],
                    [
                        'label' => 'Profile',
                        'url' => '/profile',
                    ],
                ])
                ->lastItemCssClass('testMe')
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testSubMenuTemplate(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul>
        <li><a href="user/index">Manager</a></li>
        <li><a href="user/export">Export</a></li>
        </ul>
        <li><a href="/setting">Setting</a></li>
        <li><a href="/profile">Profile</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()
                ->items([
                    ['label' => 'Users',
                        'items' => [
                            ['label' => 'Manager', 'url' => 'user/index'],
                            ['label' => 'Export', 'url' => 'user/export'],
                        ],
                    ],
                    [
                        'label' => 'Setting',
                        'url' => '/setting',
                    ],
                    [
                        'label' => 'Profile',
                        'url' => '/profile',
                    ],
                ])
                ->subMenuTemplate("<ul>\n{items}\n</ul>")
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <aside id="w1-menu" class="menu">
        <ul class="menu-list">
        <li><a href="auth/login">Login</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Menu::widget()->items([['label' => 'Login', 'url' => 'auth/login']])->render()
        );
    }
}
