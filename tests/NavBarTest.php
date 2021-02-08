<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\NavBar;

final class NavBarTest extends TestCase
{
    public function testNavBar(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBrandLabel(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBrandImage(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandImage('yii-logo.jpg')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><a class="navbar-item" href="/"><img src="yii-logo.jpg" alt=""></a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBrandUrl(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarOptions(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withOptions(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar is-black" data-sticky="" data-sticky-shadow="">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withOptions(['class' => 'navbar is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar is-black" data-sticky="" data-sticky-shadow="">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarOptionsBrand(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withBrandOptions(['class' => 'is-black'])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand is-black"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarOptionsBrandImage(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withBrandImageOptions(['class' => 'navbar-item', 'alt' => 'yii logo'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item" alt="yii logo"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarOptionsBrandLabel(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withBrandLabelOptions(['class' => 'is-italic'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item is-italic" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarOptionsItems(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withItemsOptions(['class' => 'navbar-end'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-end"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withItemsOptions(['class' => 'is-primary'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start is-primary"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withItemsOptions(['class' => 'navbar-start', 'aria-label' => 'true'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start" aria-label="true"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarOptionsMenu(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withMenuOptions(['class' => 'is-black'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu is-black"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarToggleOptions(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withToggleOptions(['class' => 'navbar-burger', 'role' => 'button'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBrand(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrand('<div>testMe</div>')
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div>testMe</div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarIconToggle(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withToggleIcon('<span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span>')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBeginExceptionTag(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag should be either string, bool or null.');
        NavBar::widget()->withOptions(['tag' => ['testMe']])->begin();
    }

    public function testNavBarRunExceptionTag(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag should be either string, bool or null.');
        NavBar::widget()->withOptions(['tag' => ['testMe']])->render();
    }

    public function testNavBarOptionsClassArray(): void
    {
        NavBar::counter(0);

        $class = ['nav'];
        $class[] = 'dark';

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withOptions(['class' => $class])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar nav dark">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarItemsOptionsClassArray(): void
    {
        NavBar::counter(0);

        $class = ['nav'];
        $class[] = 'dark';

        $html = NavBar::widget()
            ->withBrandLabel('My Project')
            ->withBrandImage('yii-logo.jpg')
            ->withBrandUrl('/')
            ->withItemsOptions(['class' => $class])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start nav dark"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testEncodeTags(): void
    {
        NavBar::counter(0);

        $html = NavBar::widget()->withBrandImage('yii-logo.jpg')->withEncodeTags()->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><a class="navbar-item" href="/">&lt;img src="yii-logo.jpg" alt=""&gt;</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
