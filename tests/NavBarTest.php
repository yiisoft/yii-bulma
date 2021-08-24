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
            ->brandLabel('My Project')
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
            ->brandImage('yii-logo.jpg')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><a class="navbar-item" href="/"><img src="yii-logo.jpg" alt></a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->options(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar is-black" data-sticky data-sticky-shadow>
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->options(['class' => 'navbar is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar is-black" data-sticky data-sticky-shadow>
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->brandOptions(['class' => 'is-black'])
            ->begin();
        $html .= NavBar::end();

        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand is-black"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->brandImageOptions(['class' => 'navbar-item', 'alt' => 'yii logo'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item" alt="yii logo"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->brandLabelOptions(['class' => 'is-italic'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item is-italic" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->itemsOptions(['class' => 'navbar-end'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-end"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->itemsOptions(['class' => 'is-primary'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start is-primary"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        NavBar::counter(0);

        $html = NavBar::widget()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->itemsOptions(['class' => 'navbar-start', 'aria-label' => 'true'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->menuOptions(['class' => 'is-black'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->toggleOptions(['class' => 'navbar-burger', 'role' => 'button'])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brand('<div>testMe</div>')
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->toggleIcon('<span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span>')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function dataExceptionTag(): array
    {
        return [
            [['test']],
            [''],
            [42],
        ];
    }

    /**
     * @dataProvider dataExceptionTag
     */
    public function testNavBarBeginExceptionTag($tag): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag should be either non empty string, bool or null.');
        NavBar::widget()->options(['tag' => $tag])->begin();
    }

    /**
     * @dataProvider dataExceptionTag
     */
    public function testNavBarRunExceptionTag($tag): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag should be either non empty string, bool or null.');
        NavBar::widget()->options(['tag' => $tag])->render();
    }

    public function testNavBarOptionsClassArray(): void
    {
        NavBar::counter(0);

        $class = ['nav'];
        $class[] = 'dark';

        $html = NavBar::widget()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->options(['class' => $class])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar nav dark">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
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
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->itemsOptions(['class' => $class])
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar">
        <div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
        <div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start nav dark"></div>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testImmutability(): void
    {
        $widget = NavBar::widget();

        $this->assertNotSame($widget, $widget->brand(''));
        $this->assertNotSame($widget, $widget->brandLabel(''));
        $this->assertNotSame($widget, $widget->brandImage(''));
        $this->assertNotSame($widget, $widget->brandUrl(''));
        $this->assertNotSame($widget, $widget->toggleIcon(''));
        $this->assertNotSame($widget, $widget->options([]));
        $this->assertNotSame($widget, $widget->brandOptions([]));
        $this->assertNotSame($widget, $widget->brandLabelOptions([]));
        $this->assertNotSame($widget, $widget->brandImageOptions([]));
        $this->assertNotSame($widget, $widget->itemsOptions([]));
        $this->assertNotSame($widget, $widget->menuOptions([]));
        $this->assertNotSame($widget, $widget->toggleOptions([]));
        $this->assertNotSame($widget, $widget->id(NavBar::class));
        $this->assertNotSame($widget, $widget->autoIdPrefix(NavBar::class));
    }
}
