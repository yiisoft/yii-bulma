<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\Menu;

final class MenuTest extends TestCase
{
    public function testMenu(): void
    {
        Menu::counter(0);

        $html = Menu::widget()->withItems([['label' => 'Login', 'url' => 'auth/login']])->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li><a href="auth/login">Login</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuItems(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withItems([
                ['label' => 'General',
                    'items' => [
                        [
                            'label' => 'Dashboard',
                            'url' => 'site/index',
                            'icon' => 'mdi mdi-desktop-mac',
                            'iconOptions' => ['class' => 'icon'],
                            'linkOptions' => ['class' => 'testMe'],
                        ],
                        [
                            'label' => 'Logout',
                            'url' => 'site/logout',
                            'icon' => 'mdi mdi-logout',
                            'iconOptions' => ['class' => 'icon'],
                            'linkOptions' => ['class' => 'testMe'],
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuItemEmpty(): void
    {
        Menu::counter(0);

        $html = Menu::widget()->withItems([])->render();
        $this->assertEmpty($html);
    }

    public function testMenuItemEmptyLabel(): void
    {
        Menu::counter(0);

        $html = Menu::widget()->withItems([['url' => '#']])->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li><a href="#"></a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuItemVisible(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withItems([
                ['label' => 'General',
                    'items' => [
                        [
                            'label' => 'Dashboard',
                            'url' => 'site/index',
                            'icon' => 'mdi mdi-desktop-mac',
                            'iconOptions' => ['class' => 'icon'],
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuEncodeLabel(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withoutEncodeLabels()
            ->withItems([
                [
                    'label' => 'Authors & Publications',
                    'url' => '#',
                    'encode' => true,
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li><a href="#">Authors &amp; Publications</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        Menu::counter(0);

        $html = Menu::widget()
            ->withItems([
                [
                    'label' => 'Authors & Publications',
                    'url' => '#',
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li><a href="#">Authors &amp; Publications</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        Menu::counter(0);

        $html = Menu::widget()
            ->withoutEncodeLabels()
            ->withItems([
                [
                    'label' => 'Authors & Publications',
                    'url' => '#',
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li><a href="#">Authors & Publications</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuTagOption(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withOptions([
                'tag' => false,
            ])
            ->withItems([
                [
                    'label' => 'item1',
                    'url' => '#',
                    'options' => ['tag' => 'div'],
                ],
                [
                    'label' => 'item2',
                    'url' => '#',
                    'options' => ['tag' => false],
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">

        <div><a href="#">item1</a></div>
        <a href="#">item2</a>

        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        Menu::counter(0);

        $html = Menu::widget()
            ->withOptions([
                'tag' => false,
            ])
            ->withItems([
                [
                    'label' => 'item1',
                    'url' => '#',
                ],
                [
                    'label' => 'item2',
                    'url' => '#',
                ],
            ])
            ->withItemOptions(['tag' => false])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">

        <a href="#">item1</a>
        <a href="#">item2</a>

        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuItemTemplate(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withLabelTemplate('')
            ->withLinkTemplate('')
            ->withItems([
                [
                    'label' => 'item1',
                    'url' => '#',
                    'template' => 'label: {label}; url: {url}',
                ],
                [
                    'label' => 'item2',
                    'template' => 'label: {label}',
                ],
                [
                    'label' => 'item3 (no template)',
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li>label: item1; url: "#"</li>
        label: <p class="menu-label">item2</p>

        item3 (no template)
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuActiveItemClosure(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withLinkTemplate('')
            ->withLabelTemplate('')
            ->withItems([
                [
                    'label' => 'item1',
                    'url' => '#',
                    'template' => 'label: {label}; url: {url}',
                    'active' => function ($item, $hasActiveChild, $isItemActive, $widget) {
                        return isset($item, $hasActiveChild, $isItemActive, $widget);
                    },
                ],
                [
                    'label' => 'item2',
                    'template' => 'label: {label}',
                    'active' => false,
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li>label: item1; url: "#" class="is-active"</li>
        label: <p class="menu-label">item2</p>

        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuItemClassAsArray(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withActiveCssClass('item-active')
            ->withItems([
                [
                    'label' => 'item1',
                    'url' => '#',
                    'active' => true,
                    'options' => [
                        'class' => [
                            'someclass',
                        ],
                    ],
                ],
                [
                    'label' => 'item2',
                    'url' => '#',
                    'options' => [
                        'class' => [
                            'another-class',
                            'other--class',
                            'two classes',
                        ],
                    ],
                ],
                [
                    'label' => 'item3',
                    'url' => '#',
                ],
                [
                    'label' => 'item4',
                    'url' => '#',
                    'options' => [
                        'class' => [
                            'some-other-class',
                            'foo_bar_baz_class',
                        ],
                    ],
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li class="someclass"><a href="#" class="item-active">item1</a></li>
        <li class="another-class other--class two classes"><a href="#">item2</a></li>
        <li><a href="#">item3</a></li>
        <li class="some-other-class foo_bar_baz_class"><a href="#">item4</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuItemClassAsString(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withActiveCssClass('item-active')
            ->withItems([
                [
                    'label' => 'item1',
                    'url' => '#',
                    'options' => [
                        'class' => 'someclass',
                    ],
                ],
                [
                    'label' => 'item2',
                    'url' => '#',
                ],
                [
                    'label' => 'item3',
                    'url' => '#',
                    'options' => [
                        'class' => 'some classes',
                    ],
                ],
                [
                    'label' => 'item4',
                    'url' => '#',
                    'active' => true,
                    'options' => [
                        'class' => 'another-class other--class two classes',
                    ],
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li class="someclass"><a href="#">item1</a></li>
        <li><a href="#">item2</a></li>
        <li class="some classes"><a href="#">item3</a></li>
        <li class="another-class other--class two classes"><a href="#" class="item-active">item4</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuCurrentPath(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withCurrentPath('/setting')
            ->withItems([
                [
                    'label' => 'Setting',
                    'url' => '/setting',
                ],
                [
                    'label' => 'Profile',
                    'url' => '/profile',
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <li><a href="/setting" class="is-active">Setting</a></li>
        <li><a href="/profile">Profile</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuFirstItemCssClass(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withCurrentPath('/setting')
            ->withFirstItemCssClass('testMe')
            ->withItems([
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuLastItemCssClass(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withCurrentPath('/setting')
            ->withLastItemCssClass('testMe')
            ->withItems([
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuActivateItems(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withoutActivateItems()
            ->withCurrentPath('user/block')
            ->withLastItemCssClass('testMe')
            ->withItems([
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);

        Menu::counter(0);

        $html = Menu::widget()
            ->withCurrentPath('user/block')
            ->withLastItemCssClass('testMe')
            ->withItems([
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuActivateParentItems(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withCurrentPath('user/block')
            ->withLastItemCssClass('testMe')
            ->withItems([
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);

        Menu::counter(0);

        $html = Menu::widget()
            ->withActivateParents()
            ->withCurrentPath('user/block')
            ->withLastItemCssClass('testMe')
            ->withItems([
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuBrand(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withBrand(
                '<div class=aside-tools>' . "\n" . '<div class=aside-tools-label>' . "\n" .
                '<span><b>Brand</b> Example</span>' . "\n" . '</div>' . "\n" . '</div>'
            )
            ->withCurrentPath('/setting')
            ->withLastItemCssClass('testMe')
            ->withItems([
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
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuHiddenItems(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withCurrentPath('/setting')
            ->withoutHideEmptyItems()
            ->withLastItemCssClass('testMe')
            ->withItems([
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
                    'items' => [],
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li><a href="user/index">Manager</a></li>
        <li class="testMe"><a href="user/export">Export</a></li>
        </ul>
        <li><a href="/setting" class="is-active">Setting</a></li>
        <p class="menu-label">Profile</p>

        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        Menu::counter(0);

        $html = Menu::widget()
            ->withCurrentPath('/setting')
            ->withLastItemCssClass('testMe')
            ->withItems([
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
                    'items' => [],
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMenuSubMenuTemplate(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withItems([
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
            ->withSubMenuTemplate('<ul>\n{items}\n</ul>')
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul>\n<li><a href="user/index">Manager</a></li>
        <li><a href="user/export">Export</a></li>\n</ul>
        <li><a href="/setting">Setting</a></li>
        <li><a href="/profile">Profile</a></li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testEncodeTags(): void
    {
        Menu::counter(0);

        $html = Menu::widget()
            ->withItems([
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
            ->withEncodeTags()
            ->render();
        $expected = <<<'HTML'
        <aside class="menu">
        <ul class="menu-list">
        <p class="menu-label">Users</p>
        <ul class = menu-list>
        <li>&lt;a href="user/index"&gt;Manager&lt;/a&gt;</li>
        <li>&lt;a href="user/export"&gt;Export&lt;/a&gt;</li>
        </ul>
        <li>&lt;a href="/setting"&gt;Setting&lt;/a&gt;</li>
        <li>&lt;a href="/profile"&gt;Profile&lt;/a&gt;</li>
        </ul>
        </aside>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
