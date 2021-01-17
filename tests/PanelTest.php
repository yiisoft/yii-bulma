<?php

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\Panel;
use InvalidArgumentException;

final class PanelTest extends TestCase
{
    public function testPanel(): void
    {
        Panel::counter(0);

        $html = Panel::widget()->render();

        $expectedHtml = <<<HTML
<nav id="w1-panel" class="panel"></nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testPanelOptions(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->options(['class' => 'my-class'])
            ->render();

        $expectedHtml = <<<HTML
<nav id="w1-panel" class="my-class panel"></nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testPanelHeading(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->heading('Repositories')
            ->render();

        $expectedHtml = <<<HTML
<nav id="w1-panel" class="panel">
<p class="panel-heading">Repositories</p>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testPanelHeadingOptions(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->heading('Repositories')
            ->headingOptions(['class' => 'my-class'])
            ->render();

        $expectedHtml = <<<HTML
<nav id="w1-panel" class="panel">
<p class="my-class panel-heading">Repositories</p>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testPanelColor(): void
    {
        Panel::counter(0);

        $html = Panel::widget()
            ->heading('Repositories')
            ->color(Panel::COLOR_PRIMARY)
            ->render();

        $expectedHtml = <<<HTML
<nav id="w1-panel" class="panel is-primary">
<p class="panel-heading">Repositories</p>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testExceptionPanelColor(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Panel::widget()->color('is-non-existent')->begin();
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

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
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

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
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

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
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
                ['label' => 'Private'],
                ['label' => 'Sources'],
                ['label' => 'Forks'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<nav id="w1-panel" class="panel">
<p class="panel-tabs">
<a class="is-active" href="#w1-panel-c0">All</a>
<a>Public</a>
<a>Private</a>
<a>Sources</a>
<a>Forks</a>
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
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

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
