<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Yii\Bulma\NavBar;

final class NavBarTest extends TestCase
{
    public function testBrandAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->brandAttributes(['class' => 'text-danger'])->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="text-danger navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandImageAndUrl(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()
            ->brandImage('https://bulma.io/images/bulma-logo.png')
            ->brandImageAttributes(['style' => ['width' => '112', 'height' => '28']])
            ->brandUrl('https://bulma.io')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io"><img src="https://bulma.io/images/bulma-logo.png" style="width: 112; height: 28;"></a>
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandText(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->brandText('My Project')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-item" href="/">My Project</a>
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandImageUrlText(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()
            ->brandImage('https://bulma.io/images/bulma-logo.png')
            ->brandImageAttributes(['title' => 'bulma', 'style' => ['width' => '112', 'height' => '28']])
            ->brandText('My Project')
            ->brandUrl('https://bulma.io')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io"><img src="https://bulma.io/images/bulma-logo.png" title="bulma" style="width: 112; height: 28;">My Project</a>
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBrandUrlEmptyText(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()
            ->brandText('My Project')
            ->brandTextAttributes(['class' => 'has-text-primary'])
            ->brandUrl('')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <span class="has-text-primary navbar-item">My Project</span>
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonLinkAriaExpanded(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->buttonLinkAriaExpanded('true')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="true" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonLinkAriaLabelText(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->buttonLinkAriaLabelText('menu-text')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu-text" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonLinkContent(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()
            ->buttonLinkContent('<span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span>')
            ->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span></a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testButtonLinkRole(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->buttonLinkRole('button-text')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button-text">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarAriaLabel(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->navBarAriaLabel('main')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBrandCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->navBarBrandCssClass('has-text-center navbar-brand')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="has-text-center navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBurgerAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->navBarBurgerAttributes(['class' => 'has-text-center'])->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="has-text-center navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarBurgerCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->navBarBurgerCssClass('has-text-center navbar-burguer')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="has-text-center navbar-burguer" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->navBarCssClass('has-text-danger navbar')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="has-text-danger navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarItemCssClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->navBarItemCssClass('has-text-center navbar-item')->brandText('link-text')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="has-text-center navbar-item" href="/">link-text</a>
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testNavBarRole(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->navBarRole('navigation-text')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation-text">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testId(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $html = NavBar::widget()->id('id-test')->begin();
        $html .= NavBar::end();
        $expected = <<<'HTML'
        <nav id="id-test" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testImmutability(): void
    {
        $widget = NavBar::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(NavBar::class));
        $this->assertNotSame($widget, $widget->brandAttributes([]));
        $this->assertNotSame($widget, $widget->brandImage(''));
        $this->assertNotSame($widget, $widget->brandImageAttributes([]));
        $this->assertNotSame($widget, $widget->brandText(''));
        $this->assertNotSame($widget, $widget->brandTextAttributes([]));
        $this->assertNotSame($widget, $widget->brandUrl(''));
        $this->assertNotSame($widget, $widget->buttonLinkAriaExpanded(''));
        $this->assertNotSame($widget, $widget->buttonLinkAriaLabelText(''));
        $this->assertNotSame($widget, $widget->buttonLinkContent(''));
        $this->assertNotSame($widget, $widget->buttonLinkRole(''));
        $this->assertNotSame($widget, $widget->id(NavBar::class));
        $this->assertNotSame($widget, $widget->navBarAriaLabel(''));
        $this->assertNotSame($widget, $widget->navBarBrandCssClass(''));
        $this->assertNotSame($widget, $widget->navBarBurgerAttributes([]));
        $this->assertNotSame($widget, $widget->navBarBurgerCssClass(''));
        $this->assertNotSame($widget, $widget->navBarCssClass(''));
        $this->assertNotSame($widget, $widget->navBarItemCssClass(''));
        $this->assertNotSame($widget, $widget->navBarRole(''));
    }
}
