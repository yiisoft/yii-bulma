<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\Panel;

final class PanelTest extends TestCase
{
    public function testAttributes(): void
    {
        $expected = <<<HTML
        <nav class="my-class panel" id="w1-panel">
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, Panel::widget()
            ->attributes(['class' => 'my-class'])
            ->render());
    }

    public function testBlockClass(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="panel-tabs">
        <a href="#w1-panel-0">all</a>
        </p>
        <a class="test-class">Tabs</a>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->blockClass('test-class')
                ->tabs([
                    ['label' => 'all', 'items' => [['label' => 'Tabs']]],
                ])
                ->render(),
        );
    }

    public function testColor(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel is-primary">
        <p class="panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->heading('Repositories')
                ->color(Panel::COLOR_PRIMARY)
                ->render(),
        );
    }

    public function testCssClass(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="test-class">
        <p class="panel-tabs">
        <a>all</a>
        </p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->cssClass('test-class')
                ->tabs([['label' => 'all']])
                ->render(),
        );
    }

    public function testExceptionColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "is-primary is-link is-info is-success is-warning is-danger is-dark".',
        );
        Panel::widget()
            ->color('is-non-existent')
            ->render();
    }

    public function testHeading(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, Panel::widget()
            ->heading('Repositories')
            ->render());
    }

    public function testHeadingClass(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="test-class">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->heading('Repositories')
                ->headingClass('test-class')
                ->render(),
        );
    }

    public function testHeadingAttributes(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="my-class panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->heading('Repositories')
                ->headingAttributes(['class' => 'my-class'])
                ->render(),
        );
    }

    public function testImmutability(): void
    {
        $widget = Panel::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Panel::class));
        $this->assertNotSame($widget, $widget->blockClass(''));
        $this->assertNotSame($widget, $widget->color('is-primary'));
        $this->assertNotSame($widget, $widget->cssClass(''));
        $this->assertNotSame($widget, $widget->heading(''));
        $this->assertNotSame($widget, $widget->headingAttributes([]));
        $this->assertNotSame($widget, $widget->headingClass(''));
        $this->assertNotSame($widget, $widget->iconClass(''));
        $this->assertNotSame($widget, $widget->id(Panel::class));
        $this->assertNotSame($widget, $widget->isActiveClass(''));
        $this->assertNotSame($widget, $widget->tabClass(''));
        $this->assertNotSame($widget, $widget->tabs([]));
        $this->assertNotSame($widget, $widget->tabsAttributes([]));
        $this->assertNotSame($widget, $widget->template(''));
    }

    public function testItemMissigLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Panel::widget()
            ->tabs([['label' => 'All', 'items' => [['icon' => 'fas fa-book']]]])
            ->render();
    }

    public function testItems(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel is-primary">
        <p class="panel-heading">Primary</p>
        <p class="panel-tabs">
        <a data-all class="is-active" href="#w1-panel-0">All</a>
        <a data-target="Public" href="#w1-panel-1">Public</a>
        <a data-target="Private" href="#w1-panel-2">Private</a>
        <a data-target="Sources" href="#w1-panel-3">Sources</a>
        <a data-target="Forks" href="#w1-panel-4">Forks</a>
        </p>
        <a data-category="All" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Breadcrumbs
        </a>
        <a data-category="All" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Dropdown
        </a>
        <a data-category="All" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Panel
        </a>
        <a data-category="All" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Tabs
        </a>
        <a data-category="Public" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Breadcrumbs
        </a>
        <a data-category="Public" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Tabs
        </a>
        <a data-category="Private" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Dropdown
        </a>
        <a data-category="Private" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Panel
        </a>
        <a data-category="Sources" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Nav
        </a>
        <a data-category="Sources" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        NavBar
        </a>
        <a data-category="Forks" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Model
        </a>
        <a data-category="Forks" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        ModalCard
        </a>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->color(Panel::COLOR_PRIMARY)
                ->heading('Primary')
                ->tabs(
                    [
                        [
                            'label' => 'All',
                            'active' => true,
                            'urlAttributes' => ['data-all' => true],
                            'items' => [
                                [
                                    'label' => 'Breadcrumbs',
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book',
                                ],
                                [
                                    'label' => 'Dropdown',
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book',
                                ],
                                [
                                    'label' => 'Panel',
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book',
                                ],
                                [
                                    'label' => 'Tabs',
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book',
                                ],
                            ],
                        ],
                        [
                            'label' => 'Public',
                            'urlAttributes' => ['data-target' => 'Public'],
                            'items' => [
                                [
                                    'label' => 'Breadcrumbs',
                                    'urlAttributes' => ['data-category' => 'Public'],
                                    'icon' => 'fas fa-book',
                                ],
                                [
                                    'label' => 'Tabs',
                                    'urlAttributes' => ['data-category' => 'Public'],
                                    'icon' => 'fas fa-book',
                                ],
                            ],
                        ],
                        [
                            'label' => 'Private',
                            'urlAttributes' => ['data-target' => 'Private'],
                            'items' => [
                                [
                                    'label' => 'Dropdown',
                                    'urlAttributes' => ['data-category' => 'Private'],
                                    'icon' => 'fas fa-book',
                                ],
                                [
                                    'label' => 'Panel',
                                    'urlAttributes' => ['data-category' => 'Private'],
                                    'icon' => 'fas fa-book',
                                ],
                            ],
                        ],
                        [
                            'label' => 'Sources',
                            'urlAttributes' => ['data-target' => 'Sources'],
                            'items' => [
                                [
                                    'label' => 'Nav',
                                    'urlAttributes' => ['data-category' => 'Sources'],
                                    'icon' => 'fas fa-book',
                                ],
                                [
                                    'label' => 'NavBar',
                                    'urlAttributes' => ['data-category' => 'Sources'],
                                    'icon' => 'fas fa-book',
                                ],
                            ],
                        ],
                        [
                            'label' => 'Forks',
                            'urlAttributes' => ['data-target' => 'Forks'],
                            'items' => [
                                [
                                    'label' => 'Model',
                                    'urlAttributes' => ['data-category' => 'Forks'],
                                    'icon' => 'fas fa-book',
                                ],
                                [
                                    'label' => 'ModalCard',
                                    'urlAttributes' => ['data-category' => 'Forks'],
                                    'icon' => 'fas fa-book',
                                ],
                            ],
                        ],
                    ],
                )
                ->render(),
        );
    }

    public function testItemsActive(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel is-primary">
        <p class="panel-heading">Primary</p>
        <p class="panel-tabs">
        <a data-all href="#w1-panel-0">All</a>
        <a data-target="Public" href="#w1-panel-1">Public</a>
        </p>
        <a data-category="All" class="panel-block is-active">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Breadcrumbs
        </a>
        <a data-category="Public" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        Tabs
        </a>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->color(Panel::COLOR_PRIMARY)
                ->heading('Primary')
                ->tabs(
                    [
                        [
                            'label' => 'All',
                            'urlAttributes' => ['data-all' => true],
                            'items' => [
                                [
                                    'label' => 'Breadcrumbs',
                                    'active' => true,
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book',
                                ],
                            ],
                        ],
                        [
                            'label' => 'Public',
                            'urlAttributes' => ['data-target' => 'Public'],
                            'items' => [
                                [
                                    'label' => 'Tabs',
                                    'urlAttributes' => ['data-category' => 'Public'],
                                    'icon' => 'fas fa-book',
                                ],
                            ],
                        ],
                    ],
                )
                ->render(),
        );
    }

    public function testRender(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, Panel::widget()->render());
    }

    public function testTabActive(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="panel-tabs">
        <a class="is-active">All</a>
        <a>Public</a>
        <a>Private</a>
        <a>Sources</a>
        <a>Forks</a>
        </p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->tabs([
                    ['label' => 'All', 'active' => true],
                    ['label' => 'Public'],
                    ['label' => 'Private'],
                    ['label' => 'Sources'],
                    ['label' => 'Forks'],
                ])
                ->render(),
        );
    }

    public function testTabMissigLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Panel::widget()
            ->tabs([[]])
            ->render();
    }

    public function testTabClass(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="test-class">
        <a>All</a>
        <a>Public</a>
        <a>Private</a>
        <a>Sources</a>
        <a>Forks</a>
        </p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->tabClass('test-class')
                ->tabs([
                    ['label' => 'All'],
                    ['label' => 'Public'],
                    ['label' => 'Private'],
                    ['label' => 'Sources'],
                    ['label' => 'Forks'],
                ])
                ->render(),
        );
    }

    public function testTabs(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="panel-tabs">
        <a>All</a>
        <a>Public</a>
        <a>Private</a>
        <a>Sources</a>
        <a>Forks</a>
        </p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->tabs([
                    ['label' => 'All'],
                    ['label' => 'Public'],
                    ['label' => 'Private'],
                    ['label' => 'Sources'],
                    ['label' => 'Forks'],
                ])
                ->render(),
        );
    }

    public function testTabsAttributes(): void
    {
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="my-class panel-tabs">
        <a>All</a>
        <a>Public</a>
        <a>Private</a>
        <a>Sources</a>
        <a>Forks</a>
        </p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->tabs([
                    ['label' => 'All'],
                    ['label' => 'Public'],
                    ['label' => 'Private'],
                    ['label' => 'Sources'],
                    ['label' => 'Forks'],
                ])
                ->tabsAttributes(['class' => 'my-class'])
                ->render(),
        );
    }

    public function testTemplate(): void
    {
        $template = <<<HTML
        {panelBegin}{panelHeading}{panelTabs}
        <div class="panel-block">
        <p class="control has-icons-left">
        <input class="input" type="text" placeholder="Search" />
        <span class="icon is-left">
        <i class="fas fa-search" aria-hidden="true"></i>
        </span>
        </p>
        </div>
        {panelItems}
        <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">
        Reset all filters
        </button>
        </div>
        {panelEnd}
        HTML;
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="panel-tabs">
        <a data-all href="#w1-panel" class="is-active">All</a>
        <a data-target="Public">Public</a>
        <a data-target="Private">Private</a>
        <a data-target="Sources">Sources</a>
        <a data-target="Fork">Forks</a>
        </p>

        <div class="panel-block">
        <p class="control has-icons-left">
        <input class="input" type="text" placeholder="Search" />
        <span class="icon is-left">
        <i class="fas fa-search" aria-hidden="true"></i>
        </span>
        </p>
        </div>
        <a data-category="All" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        bulma
        </a>
        <a data-category="All" class="panel-block">
        <span class="panel-icon">
        <i aria-hidden="true" class="fas fa-book"></i>
        </span>
        marksheet
        </a>

        <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">
        Reset all filters
        </button>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()
                ->template($template)
                ->tabs([
                    [
                        'label' => 'All',
                        'url' => '#w1-panel',
                        'active' => true,
                        'urlAttributes' => ['data-all' => true],
                        'items' => [
                            [
                                'label' => 'bulma',
                                'icon' => 'fas fa-book',
                                'urlAttributes' => ['data-category' => 'All'],
                            ],
                            [
                                'label' => 'marksheet',
                                'icon' => 'fas fa-book',
                                'urlAttributes' => ['data-category' => 'All'],
                            ],
                        ],
                    ],
                    ['label' => 'Public', 'urlAttributes' => ['data-target' => 'Public']],
                    ['label' => 'Private', 'urlAttributes' => ['data-target' => 'Private']],
                    ['label' => 'Sources', 'urlAttributes' => ['data-target' => 'Sources']],
                    ['label' => 'Forks', 'urlAttributes' => ['data-target' => 'Fork']],
                ])
                ->render(),
        );
    }
}
