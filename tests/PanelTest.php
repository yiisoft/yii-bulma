<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Panel;

final class PanelTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-panel" class="my-class panel">
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, Panel::widget()->attributes(['class' => 'my-class'])->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testColor(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-panel" class="panel is-primary">
        <p class="panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()->heading('Repositories')->color(Panel::COLOR_PRIMARY)->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExceptionColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "is-primary is-link is-info is-success is-warning is-danger is-dark".'
        );
        Panel::widget()->color('is-non-existent')->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHeading(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, Panel::widget()->heading('Repositories')->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHeadingAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        <p class="my-class panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Panel::widget()->heading('Repositories')->headingAttributes(['class' => 'my-class'])->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImmutability(): void
    {
        $widget = Panel::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Panel::class));
        $this->assertNotSame($widget, $widget->color('is-primary'));
        $this->assertNotSame($widget, $widget->heading(''));
        $this->assertNotSame($widget, $widget->headingAttributes([]));
        $this->assertNotSame($widget, $widget->id(Panel::class));
        $this->assertNotSame($widget, $widget->tabs([]));
        $this->assertNotSame($widget, $widget->tabsAttributes([]));
        $this->assertNotSame($widget, $widget->template(''));
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemMissigLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Panel::widget()->tabs([['label' => 'All', 'items' => [['icon' => 'fas fa-book']]]])->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-panel" class="panel is-primary">
        <p class="panel-heading">Primary</p>
        <p class="panel-tabs">
        <a class="is-active" href="#w1-panel" data-all>All</a>
        <a href="#w1-panel" data-target="Public">Public</a>
        <a href="#w1-panel" data-target="Private">Private</a>
        <a href="#w1-panel" data-target="Sources">Sources</a>
        <a href="#w1-panel" data-target="Forks">Forks</a>
        </p>
        <a class="panel-block" data-category="All">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Breadcrumbs
        </a>
        <a class="panel-block" data-category="All">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Dropdown
        </a>
        <a class="panel-block" data-category="All">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Panel
        </a>
        <a class="panel-block" data-category="All">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Tabs
        </a>
        <a class="panel-block" data-category="Public">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Breadcrumbs
        </a>
        <a class="panel-block" data-category="Public">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Tabs
        </a>
        <a class="panel-block" data-category="Private">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Dropdown
        </a>
        <a class="panel-block" data-category="Private">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Panel
        </a>
        <a class="panel-block" data-category="Sources">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Nav
        </a>
        <a class="panel-block" data-category="Sources">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        NavBar
        </a>
        <a class="panel-block" data-category="Forks">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        Model
        </a>
        <a class="panel-block" data-category="Forks">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
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
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'label' => 'Dropdown',
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'label' => 'Panel',
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'label' => 'Tabs',
                                    'urlAttributes' => ['data-category' => 'All'],
                                    'icon' => 'fas fa-book'
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
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'label' => 'Tabs',
                                    'urlAttributes' => ['data-category' => 'Public'],
                                    'icon' => 'fas fa-book'
                                ],
                            ]
                        ],
                        [
                            'label' => 'Private',
                            'urlAttributes' => ['data-target' => 'Private'],
                            'items' => [
                                [
                                    'label' => 'Dropdown',
                                    'urlAttributes' => ['data-category' => 'Private'],
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'label' => 'Panel',
                                    'urlAttributes' => ['data-category' => 'Private'],
                                    'icon' => 'fas fa-book'
                                ],
                            ]
                        ],
                        [
                            'label' => 'Sources',
                            'urlAttributes' => ['data-target' => 'Sources'],
                            'items' => [
                                [
                                    'label' => 'Nav',
                                    'urlAttributes' => ['data-category' => 'Sources'],
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'label' => 'NavBar',
                                    'urlAttributes' => ['data-category' => 'Sources'],
                                    'icon' => 'fas fa-book'
                                ],
                            ]

                        ],
                        [
                            'label' => 'Forks',
                            'urlAttributes' => ['data-target' => 'Forks'],
                            'items' => [
                                [
                                    'label' => 'Model',
                                    'urlAttributes' => ['data-category' => 'Forks'],
                                    'icon' => 'fas fa-book'
                                ],
                                [
                                    'label' => 'ModalCard',
                                    'urlAttributes' => ['data-category' => 'Forks'],
                                    'icon' => 'fas fa-book'
                                ],
                            ]

                        ],
                    ]
                )
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-panel" class="panel">
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, Panel::widget()->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testTabActive(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
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
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testTabMissigLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Panel::widget()->tabs([[]])->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testTabs(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
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
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testTabsAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
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
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testTemplate(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
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
        <a class="is-active" href="#w1-panel" data-all>All</a>
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
        <a class="panel-block" data-category="All">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        bulma
        </a>
        <a class="panel-block" data-category="All">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
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
                ->render()
        );
    }
}
