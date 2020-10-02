<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Html\Html;
use Yiisoft\Factory\Exceptions\InvalidConfigException;
use Yiisoft\Yii\Bulma\Nav;
use Yiisoft\Yii\Bulma\NavBar;

final class NavTest extends TestCase
{
    public function testNav(): void
    {
        NavBar::counter(0);
        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Page1',
                    'url' => '#'
                ]
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">Page1</a>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavWithoutUrl(): void
    {
        NavBar::counter(0);
        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Page1'
                ]
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">Page1</a>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavDropdown(): void
    {
        NavBar::counter(0);
        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Dropdown1',
                    'items' => [
                        ['label' => 'Page1', 'url' => '#'],
                        ['label' => 'Page2', 'url' => '#'],
                        '-',
                        ['label' => 'Page3', 'url' => '#'],
                    ]
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Dropdown1</a>
<div id="w1-dropdown" class="navbar-dropdown">
<a class="navbar-item" href="#">Page1</a>
<a class="navbar-item" href="#">Page2</a>
<div class="navbar-divider"></div>
<a class="navbar-item" href="#">Page3</a>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRenderDropdownWithDropdownOptions(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Page1',
                    'url' => '#',
                ],
                [
                    'label' => 'Dropdown1',
                    'dropdownOptions' => ['class' => 'test', 'data-id' => 't1', 'id' => 'test1'],
                    'items' => [
                        ['label' => 'Page2', 'url' => '#'],
                        ['label' => 'Page3', 'url' => '#'],
                    ],
                    'visible' => true
                ],
                [
                    'label' => 'Dropdown2',
                    'items' => [
                        ['label' => 'Page4', 'url' => '#'],
                        ['label' => 'Page5', 'url' => '#'],
                    ],
                    'visible' => false
                ]
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">Page1</a>
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Dropdown1</a>
<div id="test1" class="navbar-dropdown test" data-id="t1">
<a class="navbar-item" href="#">Page2</a>
<a class="navbar-item" href="#">Page3</a>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavEmptyItems(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Page1',
                    'items' => null,
                ],
                [
                    'label' => 'Page4',
                    'items' => [],
                ]
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">Page1</a>
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Page4</a>
<div id="w1-dropdown" class="navbar-dropdown">

</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavExplicitActive(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->activateItems(false)
            ->items([
                [
                    'label' => 'Item1',
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    'url' => '/site/index',
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">Item1</a>
<a class="navbar-item" href="/site/index">Item2</a>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavImplicitActive(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->currentPath('/site/index')
            ->items([
                [
                    'label' => 'Item1',
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    'url' => '/site/index',
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item is-active" href="#">Item1</a>
<a class="navbar-item is-active" href="/site/index">Item2</a>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavExplicitActiveSubitems(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->activateItems(false)
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
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">Item1</a>
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Item2</a>
<div id="w1-dropdown" class="navbar-dropdown">
<a class="navbar-item" href="site/index">Page2</a>
<a class="navbar-item is-active" href="#">Page3</a>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavImplicitActiveSubitems(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->items([
                [
                    'label' => 'Item1',
                ],
                [
                    'label' => 'Item2',
                    'items' => [
                        ['label' => 'Page2', 'content' => 'Page2', 'url' => '/site/index'],
                        ['label' => 'Page3', 'content' => 'Page3', 'active' => true],
                    ],
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">Item1</a>
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Item2</a>
<div id="w1-dropdown" class="navbar-dropdown">
<a class="navbar-item" href="/site/index">Page2</a>
<a class="navbar-item is-active">Page3</a>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavDeepActivateParents(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->activateParents(true)
            ->items([
                [
                    'label' => 'Dropdown',
                    'items' => [
                        [
                            'label' => 'Sub-dropdown',
                            'items' => [
                                ['label' => 'Page', 'url' => '#', 'active' => true],
                            ],
                        ],
                    ],
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Dropdown</a>
<div id="w1-dropdown" class="navbar-dropdown">
<a class="navbar-item" aria-haspopup="true" aria-expanded="false">Sub-dropdown</a>
<div id="w2-dropdown" class="navbar-dropdown">
<a class="navbar-item is-active" href="#">Page</a>
</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavEncodeLabels(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->items([
                [
                    'label' => 'a &amp; b',
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">a &amp;amp; b</a>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavWithoutEncodeLabels(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->encodeLabels(false)
            ->items([
                [
                    'label' => 'a &amp; b',
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">a &amp; b</a>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavWithoutEncodeLabelsItem(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->encodeLabels(true)
            ->items([
                [
                    'label' => 'a &amp; b',
                    'encode' => false
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">a &amp; b</a>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavDropdownDivider(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->encodeLabels(true)
            ->items([
                [
                    'label' => 'index',
                    'url' => '#'
                ],
                [
                    'label' => 'Dropdown',
                    'items' => [
                        ['label' => 'Level 1', 'url' => '#'],
                        '-',
                        ['label' => 'Level 2', 'url' => '#'],
                    ],
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#">index</a>
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Dropdown</a>
<div id="w1-dropdown" class="navbar-dropdown">
<a class="navbar-item" href="#">Level 1</a>
<div class="navbar-divider"></div>
<a class="navbar-item" href="#">Level 2</a>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavExceptionLabelItems(): void
    {
        Nav::counter(0);

        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage("The 'label' option is required.");

        Nav::widget()
            ->encodeLabels(true)
            ->items([
                [
                    'items' => [
                        ['url' => '#'],
                        '-',
                        ['label' => 'Level 2', 'url' => '#', 'visible' => true],
                    ],
                ],
            ])
            ->render();
    }


    public function testNavDropdownItemsEncodeLabels(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->encodeLabels(true)
            ->items([
                [
                    'label' => 'Dropdown',
                    'items' => [
                        ['label' => 'a &amp; b', 'url' => '#', 'encode' => false],
                        '-',
                        ['label' => 'Level 2', 'url' => '#', 'visible' => true],
                    ],
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Dropdown</a>
<div id="w1-dropdown" class="navbar-dropdown">
<a class="navbar-item" href="#">a &amp; b</a>
<div class="navbar-divider"></div>
<a class="navbar-item" href="#">Level 2</a>
</div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavDropdownExceptionLabelItems(): void
    {
        Nav::counter(0);

        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage("The 'label' option is required.");

        Nav::widget()
            ->encodeLabels(true)
            ->items([
                [
                    'label' => 'Dropdown',
                    'items' => [
                        ['url' => '#'],
                        '-',
                        ['label' => 'Level 2', 'url' => '#', 'visible' => true],
                    ],
                ],
            ])
            ->render();
    }

    public function testNavLinkDisabled(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->encodeLabels(true)
            ->items([
                [
                    'label' => 'Link disable',
                    'url' => '#',
                    'disabled' => true
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<a class="navbar-item" href="#" style="opacity:.65; pointer-events:none;">Link disable</a>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavDropdownLinkDisabled(): void
    {
        Nav::counter(0);

        $html = Nav::widget()
            ->encodeLabels(true)
            ->items([
                [
                    'label' => 'Link disable',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Level 1', 'url' => '#', 'disabled' => true],
                        ['label' => 'Level 2', 'url' => '#'],
                    ],
                ]
            ])
            ->render();

        $expectedHtml = <<<HTML
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Link disable</a>
<div id="w1-dropdown" class="navbar-dropdown">
<a class="navbar-item" href="#" style="opacity:.65; pointer-events:none;">Level 1</a>
<a class="navbar-item" href="#">Level 2</a>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavIcon(): void
    {
        Nav::counter(0);
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->options(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
            ->itemsOptions(['class' => 'navbar-end'])
            ->start();

        $html .= Nav::widget()
            ->items([
                [
                    'label' => 'Setting Account',
                    'url' => '/setting/account',
                    'icon' => 'fas fa-user-cog',
                    'iconOptions' => ['class' => 'icon']
                ],
                [
                    'label' => 'Profile',
                    'url' => '/profile',
                    'icon' => 'fas fa-users',
                    'iconOptions' => ['class' => 'icon']
                ],
                [
                    'label' => 'Admin' . Html::img(
                        '../../docs/images/icon-avatar.png',
                        ['class' => 'img-rounded', 'aria-expanded' => 'false']
                    ),
                    'items' => [
                        ['label' => 'Logout', 'url' => '/auth/logout'],
                    ],
                    'encode' => false
                ]
            ])
            ->render();

        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar is-black" data-sticky="" data-sticky-shadow="">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-end"><a class="navbar-item" href="/setting/account"><span class="icon"><i class="fas fa-user-cog"></i></span><span>Setting Account</span></a>
<a class="navbar-item" href="/profile"><span class="icon"><i class="fas fa-users"></i></span><span>Profile</span></a>
<div class="navbar-item has-dropdown is-hoverable">
<a class="navbar-link" href="#">Admin<img class="img-rounded" src="../../docs/images/icon-avatar.png" alt="" aria-expanded="false"></a>
<div id="w2-dropdown" class="navbar-dropdown">
<a class="navbar-item" href="/auth/logout">Logout</a>
</div>
</div></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
