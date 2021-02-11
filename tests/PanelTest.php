<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\Panel;

final class PanelTest extends TestCase
{
    public function testPanel(): void
    {
        Panel::counter(0);

        $html = Panel::widget()->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="panel"></nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelOptions(): void
    {
        Panel::counter(0);

        $html = Panel::widget()->options(['class' => 'my-class'])->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="my-class panel"></nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelHeading(): void
    {
        Panel::counter(0);

        $html = Panel::widget()->heading('Repositories')->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="panel">
        <p class="panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelHeadingOptions(): void
    {
        Panel::counter(0);

        $html = Panel::widget()->heading('Repositories')->headingOptions(['class' => 'my-class'])->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="panel">
        <p class="my-class panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelColor(): void
    {
        Panel::counter(0);

        $html = Panel::widget()->heading('Repositories')->color(Panel::COLOR_PRIMARY)->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="panel is-primary">
        <p class="panel-heading">Repositories</p>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testExceptionPanelColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Panel::widget()->color('is-non-existent')->render();
    }

    public function testPanelTabs(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->tabs([
                ['label' => 'All'],
                ['label' => 'Public'],
                ['label' => 'Private'],
                ['label' => 'Sources'],
                ['label' => 'Forks'],
            ])
            ->render();
        $expected = <<<'HTML'
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelTabsOptions(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->tabs([
                ['label' => 'All'],
                ['label' => 'Public'],
                ['label' => 'Private'],
                ['label' => 'Sources'],
                ['label' => 'Forks'],
            ])
            ->tabsOptions(['class' => 'my-class'])
            ->render();
        $expected = <<<'HTML'
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelTabActive(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->tabs([
                ['label' => 'All', 'active' => true],
                ['label' => 'Public'],
                ['label' => 'Private'],
                ['label' => 'Sources'],
                ['label' => 'Forks'],
            ])
            ->render();
        $expected = <<<'HTML'
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelItems(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->tabs([
                [
                    'label' => 'All',
                    'active' => true,
                    'items' => [
                        [
                            'label' => 'bulma',
                            'icon' => 'fas fa-book',
                            'active' => true,
                        ],
                        [
                            'label' => 'marksheet',
                            'icon' => 'fas fa-book',
                        ],
                    ],
                ],
                ['label' => 'Public'],
                ['label' => 'Private', 'url' => '/private'],
                ['label' => 'Sources', 'url' => '/sources'],
                ['label' => 'Forks', 'url' => '#'],
            ])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="panel">
        <p class="panel-tabs">
        <a class="is-active" href="#w1-panel-c0">All</a>
        <a>Public</a>
        <a href="/private">Private</a>
        <a href="/sources">Sources</a>
        <a href="#">Forks</a>
        </p>
        <div id="w1-panel-c0">
        <a class="panel-block is-active">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        bulma
        </a>
        <a class="panel-block">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        marksheet
        </a>
        </div></nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelItemsContainerOptions(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->tabs([
                [
                    'label' => 'All',
                    'active' => true,
                    'itemsContainerOptions' => [
                        'class' => 'some-class-name',
                    ],
                    'items' => [
                        [
                            'label' => 'bulma',
                            'icon' => 'fas fa-book',
                            'active' => true,
                        ],
                        [
                            'label' => 'marksheet',
                            'icon' => 'fas fa-book',
                        ],
                    ],
                ],
                ['label' => 'Public'],
                ['label' => 'Private'],
                ['label' => 'Sources'],
                [
                    'label' => 'Forks',
                    'items' => [
                        [
                            'label' => 'minireset.css',
                            'icon' => 'fas fa-book',
                            'active' => true,
                        ],
                        [
                            'label' => 'jgthms.github.io',
                            'icon' => 'fas fa-book',
                        ],
                    ],
                ],
            ])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="panel">
        <p class="panel-tabs">
        <a class="is-active" href="#w1-panel-c0">All</a>
        <a>Public</a>
        <a>Private</a>
        <a>Sources</a>
        <a href="#w1-panel-c4">Forks</a>
        </p>
        <div id="w1-panel-c0" class="some-class-name">
        <a class="panel-block is-active">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        bulma
        </a>
        <a class="panel-block">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        marksheet
        </a>
        </div>
        <div id="w1-panel-c4">
        <a class="panel-block is-active">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        minireset.css
        </a>
        <a class="panel-block">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        jgthms.github.io
        </a>
        </div></nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testPanelTemplate(): void
    {
        Panel::counter(0);

        $template = <<<'HTML'
        {panelBegin}
        {panelHeading}
        {panelTabs}
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
        $html = Panel::widget()
            ->template($template)
            ->tabs([
                [
                    'label' => 'All',
                    'active' => true,
                    'items' => [
                        [
                            'label' => 'bulma',
                            'icon' => 'fas fa-book',
                        ],
                        [
                            'label' => 'marksheet',
                            'icon' => 'fas fa-book',
                        ],
                    ],
                ],
                ['label' => 'Public'],
                ['label' => 'Private'],
                ['label' => 'Sources'],
                ['label' => 'Forks'],
            ])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-panel" class="panel">


        <p class="panel-tabs">
        <a class="is-active" href="#w1-panel-c0">All</a>
        <a>Public</a>
        <a>Private</a>
        <a>Sources</a>
        <a>Forks</a>
        </p>

        <div class="panel-block">
        <p class="control has-icons-left">
        <input class="input" type="text" placeholder="Search" />
        <span class="icon is-left">
        <i class="fas fa-search" aria-hidden="true"></i>
        </span>
        </p>
        </div>
        <div id="w1-panel-c0">
        <a class="panel-block">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        bulma
        </a>
        <a class="panel-block">
        <span class="panel-icon">
        <i class="fas fa-book" aria-hidden="true"></i>
        </span>
        marksheet
        </a>
        </div>
        <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">
        Reset all filters
        </button>
        </div>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testTabMissigLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Panel::widget()->tabs([[]])->render();
    }

    public function testItemMissigLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Panel::widget()->tabs([['label' => 'All', 'items' => [['icon' => 'fas fa-book']]]])->render();
    }
}
