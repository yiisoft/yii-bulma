<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\NavBar;

final class NavBarTest extends TestCase
{
    public function testAriaLabel(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->ariaLabel('main')
                ->begin() . NavBar::end(),
        );
    }

    public function testBrandAttributes(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->brandAttributes(['class' => 'text-danger'])
                ->begin() . NavBar::end(),
        );
    }

    public function testBrandCssClass(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->brandCssClass('has-text-center navbar-brand')
                ->begin() . NavBar::end(),
        );
    }

    public function testBrandImageAndUrl(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->brandImage('https://bulma.io/images/bulma-logo.png')
                ->brandImageAttributes(['style' => ['width' => '112', 'height' => '28']])
                ->brandUrl('https://bulma.io')
                ->begin()
            . NavBar::end(),
        );
    }

    public function testBrandText(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE($expected, NavBar::widget()
                ->brandText('My Project')
                ->begin() . NavBar::end());
    }

    public function testBrandImageUrlText(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->brandImage('https://bulma.io/images/bulma-logo.png')
                ->brandImageAttributes(['title' => 'bulma', 'style' => ['width' => '112', 'height' => '28']])
                ->brandText('My Project')
                ->brandUrl('https://bulma.io')
                ->begin()
            . NavBar::end(),
        );
    }

    public function testBrandUrlEmptyText(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->brandText('My Project')
                ->brandTextAttributes(['class' => 'has-text-primary'])
                ->brandUrl('')
                ->begin()
            . NavBar::end(),
        );
    }

    public function testBurgerAttributes(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->burgerAttributes(['class' => 'has-text-center'])
                ->begin() . NavBar::end(),
        );
    }

    public function testBurgerCssClass(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->burgerCssClass('has-text-center navbar-burguer')
                ->begin() . NavBar::end(),
        );
    }

    public function testButtonLinkAriaExpanded(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->buttonLinkAriaExpanded('true')
                ->begin() . NavBar::end(),
        );
    }

    public function testButtonLinkAriaLabelText(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->buttonLinkAriaLabelText('menu-text')
                ->begin() . NavBar::end(),
        );
    }

    public function testButtonLinkContent(): void
    {
        $expected = <<<HTML
        <nav id="w1-navbar" class="navbar" aria-label="main navigation" role="navigation">
        <div class="navbar-brand">
        <a class="navbar-burger" aria-expanded="false" aria-label="menu" role="button"><span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span></a>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->buttonLinkContent('<span class="icon"><i class="mdi mdi-menu mdi-24px"></i></span>')
                ->begin()
            . NavBar::end(),
        );
    }

    public function testButtonLinkRole(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->buttonLinkRole('button-text')
                ->begin() . NavBar::end(),
        );
    }

    public function testCssClass(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->cssClass('has-text-danger navbar')
                ->begin() . NavBar::end(),
        );
    }

    public function testId(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE($expected, NavBar::widget()
                ->id('id-test')
                ->begin() . NavBar::end());
    }

    public function testImmutability(): void
    {
        $widget = NavBar::widget();

        $this->assertNotSame($widget, $widget->ariaLabel(''));
        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(NavBar::class));
        $this->assertNotSame($widget, $widget->brandAttributes([]));
        $this->assertNotSame($widget, $widget->brandCssClass(''));
        $this->assertNotSame($widget, $widget->brandImage(''));
        $this->assertNotSame($widget, $widget->brandImageAttributes([]));
        $this->assertNotSame($widget, $widget->brandText(''));
        $this->assertNotSame($widget, $widget->brandTextAttributes([]));
        $this->assertNotSame($widget, $widget->brandUrl(''));
        $this->assertNotSame($widget, $widget->burgerAttributes([]));
        $this->assertNotSame($widget, $widget->burgerCssClass(''));
        $this->assertNotSame($widget, $widget->buttonLinkAriaExpanded(''));
        $this->assertNotSame($widget, $widget->buttonLinkAriaLabelText(''));
        $this->assertNotSame($widget, $widget->buttonLinkContent(''));
        $this->assertNotSame($widget, $widget->buttonLinkRole(''));
        $this->assertNotSame($widget, $widget->cssClass(''));
        $this->assertNotSame($widget, $widget->id(NavBar::class));
        $this->assertNotSame($widget, $widget->itemCssClass(''));
        $this->assertNotSame($widget, $widget->role(''));
    }

    public function testItemCssClass(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->brandText('link-text')
                ->itemCssClass('has-text-center navbar-item')
                ->begin()
            . NavBar::end(),
        );
    }

    public function testRender(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE($expected, NavBar::widget()->begin() . NavBar::end());
    }

    public function testRole(): void
    {
        $expected = <<<HTML
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
        $this->assertEqualsWithoutLE(
            $expected,
            NavBar::widget()
                ->role('navigation-text')
                ->begin() . NavBar::end(),
        );
    }
}
