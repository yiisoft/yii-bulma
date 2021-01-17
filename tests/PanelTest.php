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
<a id="w1-panel-tab-0">All</a>
<a id="w1-panel-tab-1">Public</a>
<a id="w1-panel-tab-2">Private</a>
<a id="w1-panel-tab-3">Sources</a>
<a id="w1-panel-tab-4">Forks</a>
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
<a id="w1-panel-tab-0">All</a>
<a id="w1-panel-tab-1">Public</a>
<a id="w1-panel-tab-2">Private</a>
<a id="w1-panel-tab-3">Sources</a>
<a id="w1-panel-tab-4">Forks</a>
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
<a id="w1-panel-tab-0" class="is-active">All</a>
<a id="w1-panel-tab-1">Public</a>
<a id="w1-panel-tab-2">Private</a>
<a id="w1-panel-tab-3">Sources</a>
<a id="w1-panel-tab-4">Forks</a>
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
<a id="w1-panel-tab-0" class="is-active">All</a>
<a id="w1-panel-tab-1">Public</a>
<a id="w1-panel-tab-2">Private</a>
<a id="w1-panel-tab-3">Sources</a>
<a id="w1-panel-tab-4">Forks</a>
</p>
<a class="panel-block is-active">
<span class="panel-icon">
<i class="fas fa-book" aria-hidden="true"></i>
</span>
bulma
</a>
</nav>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
