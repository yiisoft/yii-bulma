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

        $html = Tabs::widget()->render();

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
            ->items([
                ['label' => 'Tab 1', 'url' => 'site/index'],
                ['label' => 'Tab 2', 'url' => 'site/contact'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li id="w1-tabs-0" class="is-active"><a href="site/index">Tab 1</a></li>
<li id="w1-tabs-1"><a href="site/contact">Tab 2</a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testItems()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
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
<li id="w1-tabs-0" class="some-class-1 is-active"><a class="some-class-2" href="site/contact">Tab 1</a></li>
<li id="w1-tabs-1"><a><span>Tab 2</span></a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testOptions()
    {
        Tabs::counter(0);

        $html = Tabs::widget()
            ->options(['class' => 'some-class'])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs some-class">
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
            ->items([
                ['label' => 'Tab 1', 'url' => 'site/index'],
                ['label' => 'Tab 2', 'url' => 'site/contact'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li id="w1-tabs-0"><a href="site/index">Tab 1</a></li>
<li id="w1-tabs-1"><a href="site/contact">Tab 2</a></li>
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
            ->items([
                ['label' => Html::tag('span', 'Tab 1')],
                ['label' => Html::tag('span', 'Tab 2')],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li id="w1-tabs-0"><a><span>Tab 1</span></a></li>
<li id="w1-tabs-1"><a><span>Tab 2</span></a></li>
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
            ->items([
                ['label' => 'Music', 'icon' => 'fas fa-music', 'iconOptions' => ['class' => 'some-class']],
                ['label' => 'Videos', 'icon' => 'fas fa-film'],
            ])
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-tabs" class="tabs">
<ul>
<li id="w1-tabs-0"><a><span class="icon is-small some-class"><i class="fas fa-music" aria-hidden="true"></i></span><span>Music</span></a></li>
<li id="w1-tabs-1"><a><span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span><span>Videos</span></a></li>
</ul>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
