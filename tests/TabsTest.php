<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Tabs;

final class TabsTest extends TestCase
{
    public function testTabs()
    {
        Tabs::counter(0);

        $html = Tabs::widget()->renderTabsContent(false)->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCurrentPath()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->currentPath('site/index')
            ->renderTabsContent(false)
            ->items([
                ['label' => 'Tab 1', 'url' => 'site/index'],
                ['label' => 'Tab 2', 'url' => 'site/contact'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li class="is-active"><a href="site/index">Tab 1</a></li>
<li><a href="site/contact">Tab 2</a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testItems()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->renderTabsContent(false)
            ->items([
                [
                    'label' => 'Tab 1',
                    'url' => 'site/contact',
                    'active' => true,
                    'options' => [
                        'class' => 'some-class-1',
                    ],
                    'linkOptions' => [
                        'class' => 'some-class-2',
                    ],
                ],
                [
                    'label' => Html::tag('span', 'Tab 2'),
                    'encode' => false,
                ],
                [
                    'label' => 'Tab 3',
                    'visible' => false,
                ],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li class="some-class-1 is-active"><a class="some-class-2" href="site/contact">Tab 1</a></li>
<li><a><span>Tab 2</span></a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testOptions()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->renderTabsContent(false)
            ->options(['class' => 'some-class'])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="some-class tabs">
<ul>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testActivateItems()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->currentPath('site/index')
            ->activateItems(false)
            ->renderTabsContent(false)
            ->items([
                ['label' => 'Tab 1', 'url' => 'site/index'],
                ['label' => 'Tab 2', 'url' => 'site/contact'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li><a href="site/index">Tab 1</a></li>
<li><a href="site/contact">Tab 2</a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testEncodeLabels()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->encodeLabels(false)
            ->renderTabsContent(false)
            ->items([
                ['label' => Html::tag('span', 'Tab 1')],
                ['label' => Html::tag('span', 'Tab 2')],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li><a><span>Tab 1</span></a></li>
<li><a><span>Tab 2</span></a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testSize()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->size(Tabs::SIZE_LARGE)
            ->renderTabsContent(false)
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs is-large">
<ul>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testAlignment()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->alignment(Tabs::ALIGNMENT_CENTERED)
            ->renderTabsContent(false)
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs is-centered">
<ul>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testStyle()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->style(Tabs::STYLE_TOGGLE_ROUNDED)
            ->renderTabsContent(false)
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs is-toggle is-toggle-rounded">
<ul>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testIcon()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->renderTabsContent(false)
            ->items([
                ['label' => 'Pictures', 'icon' => 'fas fa-image'],
                ['label' => 'Music', 'icon' => 'fas fa-music'],
                ['label' => 'Videos', 'icon' => 'fas fa-film'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li><a><span class="icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span><span>Pictures</span></a></li>
<li><a><span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span><span>Music</span></a></li>
<li><a><span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span><span>Videos</span></a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testIconOptions()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->renderTabsContent(false)
            ->items([
                [
                    'label' => 'Pictures',
                    'icon' => 'fas fa-image',
                    'iconOptions' => [
                        'rightSide' => true,
                        'class' => 'some-class',
                    ],
                ],
                ['label' => 'Music', 'icon' => 'fas fa-music'],
                ['label' => 'Videos', 'icon' => 'fas fa-film'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li><a><span>Pictures</span><span class="some-class icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span></a></li>
<li><a><span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span><span>Music</span></a></li>
<li><a><span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span><span>Videos</span></a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testExceptionSize(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Tabs::widget()->size('is-non-existent')->begin();
    }

    public function testExceptionAlignment(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Tabs::widget()->alignment('is-non-existent')->begin();
    }

    public function testExceptionStyle(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        Tabs::widget()->style('is-non-existent')->begin();
    }

    public function testTabsContent()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->items([
                ['label' => 'Pictures', 'active' => true, 'content' => 'Some text about pictures'],
                ['label' => 'Music', 'content' => 'Some text about music'],
                ['label' => 'Videos', 'content' => 'Some text about videos'],
                ['label' => 'Documents', 'content' => 'Some text about documents'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li class="is-active"><a href="#w1-tabs-c0">Pictures</a></li>
<li><a href="#w1-tabs-c1">Music</a></li>
<li><a href="#w1-tabs-c2">Videos</a></li>
<li><a href="#w1-tabs-c3">Documents</a></li>
</ul>
</div>
<div class="tabs-content">
<div id="w1-tabs-c0">Some text about pictures</div>
<div id="w1-tabs-c1" class="is-hidden">Some text about music</div>
<div id="w1-tabs-c2" class="is-hidden">Some text about videos</div>
<div id="w1-tabs-c3" class="is-hidden">Some text about documents</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRenderTabsContent()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->renderTabsContent(false)
            ->items([
                ['label' => 'Pictures', 'active' => true, 'content' => 'Some text about pictures'],
                ['label' => 'Music', 'content' => 'Some text about music'],
                ['label' => 'Videos', 'content' => 'Some text about videos'],
                ['label' => 'Documents', 'content' => 'Some text about documents'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li class="is-active"><a>Pictures</a></li>
<li><a>Music</a></li>
<li><a>Videos</a></li>
<li><a>Documents</a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testTabsContentOptions()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->tabsContentOptions([
                'class' => 'some-class-name',
            ])
            ->items([
                ['label' => 'Pictures', 'active' => true, 'content' => 'Some text about pictures'],
                ['label' => 'Music', 'content' => 'Some text about music'],
                ['label' => 'Videos', 'content' => 'Some text about videos'],
                ['label' => 'Documents', 'content' => 'Some text about documents'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li class="is-active"><a href="#w1-tabs-c0">Pictures</a></li>
<li><a href="#w1-tabs-c1">Music</a></li>
<li><a href="#w1-tabs-c2">Videos</a></li>
<li><a href="#w1-tabs-c3">Documents</a></li>
</ul>
</div>
<div class="some-class-name tabs-content">
<div id="w1-tabs-c0">Some text about pictures</div>
<div id="w1-tabs-c1" class="is-hidden">Some text about music</div>
<div id="w1-tabs-c2" class="is-hidden">Some text about videos</div>
<div id="w1-tabs-c3" class="is-hidden">Some text about documents</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
