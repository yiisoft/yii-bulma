<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\NavBar;

final class NavBarTest extends TestCase
{
    public function testNavBar(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarBrandLabel(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarBrandImage(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandImage('yii-logo.jpg')
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><a class="navbar-item" href="/"><img src="yii-logo.jpg" alt=""></a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);

        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarBrandUrl(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarOptions(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->options(['class' => 'is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar is-black" data-sticky="" data-sticky-shadow="">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);

        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->options(['class' => 'navbar is-black', 'data-sticky' => '', 'data-sticky-shadow' => ''])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar is-black" data-sticky="" data-sticky-shadow="">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarOptionsBrand(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsBrand(['class' => 'is-black'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand is-black"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarOptionsBrandImage(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsBrandImage(['class' => 'navbar-item', 'alt' => 'yii logo'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item" alt="yii logo"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarOptionsBrandLabel(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsBrandLabel(['class' => 'is-italic'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item is-italic" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarOptionsItems(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsItems(['class' => 'navbar-end'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-end"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);

        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsItems(['class' => 'is-primary'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start is-primary"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);

        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsItems(['class' => 'navbar-start', 'aria-label' => 'true'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start" aria-label="true"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarOptionsMenu(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsMenu(['class' => 'is-black'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu is-black"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testNavBarToggleOptions(): void
    {
        NavBar::counter(0);

        $html = NavBar::begin()
            ->brandLabel('My Project')
            ->brandImage('yii-logo.jpg')
            ->brandUrl('/')
            ->optionsToggle(['class' => 'navbar-burger', 'role' => 'button'])
            ->start();
        $html .= NavBar::end();

        $expectedHtml = <<<HTML
<nav id="w1-navbar" class="navbar">
<div class="navbar-brand"><span class="navbar-item"><img src="yii-logo.jpg" alt=""></span><a class="navbar-item" href="/">My Project</a><a class="navbar-burger" role="button"><span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span></a></div>
<div id="w1-navbar-Menu" class="navbar-menu"><div class="navbar-start"></div>
</div>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
