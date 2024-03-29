<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Tabs;

final class TabsTest extends TestCase
{
    public function testActivateItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li><a href="site/index">Tab 1</a></li>
        <li><a href="site/contact">Tab 2</a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->currentPath('site/index')
                ->deactivateItems()
                ->items([
                    ['label' => 'Tab 1', 'url' => 'site/index'],
                    ['label' => 'Tab 2', 'url' => 'site/contact'],
                ])
                ->render()
        );
    }

    public function testAlignment(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs is-centered">
        <ul>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Tabs::widget()
            ->alignment(Tabs::ALIGNMENT_CENTERED)
            ->render());
    }

    public function testAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="some-class tabs">
        <ul>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Tabs::widget()
            ->attributes(['class' => 'some-class'])
            ->render());
    }

    public function testCurrentPath(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li class="is-active"><a href="site/index">Tab 1</a></li>
        <li><a href="site/contact">Tab 2</a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->currentPath('site/index')
                ->items([
                    ['label' => 'Tab 1', 'url' => 'site/index'],
                    ['label' => 'Tab 2', 'url' => 'site/contact'],
                ])
                ->render()
        );
    }

    public function testEncode(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li><a>&lt;span&gt;Tab 1&lt;/span&gt;</a></li>
        <li><a>&lt;span&gt;Tab 2&lt;/span&gt;</a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->items([
                    ['label' => Html::tag('span', 'Tab 1')],
                    ['label' => Html::tag('span', 'Tab 2')],
                ])
                ->render()
        );

        $expected = <<<HTML
        <div id="w2-tabs" class="tabs">
        <ul>
        <li><a><span>Tab 1</span></a></li>
        <li><a><span>Tab 2</span></a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->encode(false)
                ->items([
                    ['label' => Html::tag('span', 'Tab 1')],
                    ['label' => Html::tag('span', 'Tab 2')],
                ])
                ->render()
        );
    }

    public function testExceptionSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Tabs::widget()
            ->size('is-non-existent')
            ->render();
    }

    public function testExceptionAlignment(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Tabs::widget()
            ->alignment('is-non-existent')
            ->render();
    }

    public function testExceptionStyle(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Tabs::widget()
            ->style('is-non-existent')
            ->render();
    }

    public function testIcon(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li><a><span class="icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span><span>Pictures</span></a></li>
        <li><a><span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span><span>Music</span></a></li>
        <li><a><span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span><span>Videos</span></a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->items([
                    ['label' => 'Pictures', 'icon' => 'fas fa-image'],
                    ['label' => 'Music', 'icon' => 'fas fa-music'],
                    ['label' => 'Videos', 'icon' => 'fas fa-film'],
                ])
                ->render()
        );
    }

    public function testIconAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li><a><span>Pictures</span><span class="some-class icon is-small"><i class="fas fa-image" aria-hidden="true"></i></span></a></li>
        <li><a><span class="icon is-small"><i class="fas fa-music" aria-hidden="true"></i></span><span>Music</span></a></li>
        <li><a><span class="icon is-small"><i class="fas fa-film" aria-hidden="true"></i></span><span>Videos</span></a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->items([
                    [
                        'label' => 'Pictures',
                        'icon' => 'fas fa-image',
                        'iconAttributes' => [
                            'rightSide' => true,
                            'class' => 'some-class',
                        ],
                    ],
                    ['label' => 'Music', 'icon' => 'fas fa-music'],
                    ['label' => 'Videos', 'icon' => 'fas fa-film'],
                ])
                ->render()
        );
    }

    public function testImmutability(): void
    {
        $widget = Tabs::widget();

        $this->assertNotSame($widget, $widget->alignment('is-centered'));
        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Tabs::class));
        $this->assertNotSame($widget, $widget->currentPath(''));
        $this->assertNotSame($widget, $widget->deactivateItems());
        $this->assertNotSame($widget, $widget->encode(false));
        $this->assertNotSame($widget, $widget->id(Tabs::class));
        $this->assertNotSame($widget, $widget->items([]));
        $this->assertNotSame($widget, $widget->size('is-small'));
        $this->assertNotSame($widget, $widget->style('is-boxed'));
        $this->assertNotSame($widget, $widget->tabsContentAttributes([]));
    }

    public function testItems(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li class="some-class-1 is-active"><a class="some-class-2" href="site/contact">Tab 1</a></li>
        <li><a><span>Tab 2</span></a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->items([
                    [
                        'label' => 'Tab 1',
                        'url' => 'site/contact',
                        'active' => true,
                        'attributes' => [
                            'class' => 'some-class-1',
                        ],
                        'urlAttributes' => [
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
                ->render()
        );
    }

    public function testItemsAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-test-id" class="tabs">
        <ul class="test-class">
        <li class="some-class-1 is-active"><a class="some-class-2" href="site/contact">Tab 1</a></li>
        <li><a><span>Tab 2</span></a></li>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->id('w1-test-id')
                ->itemsAttributes(['class' => 'test-class'])
                ->items([
                    [
                        'label' => 'Tab 1',
                        'url' => 'site/contact',
                        'active' => true,
                        'attributes' => [
                            'class' => 'some-class-1',
                        ],
                        'urlAttributes' => [
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
                ->render()
        );
    }

    public function testMissingLabel(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Tabs::widget()
            ->items([['content' => 'Some text about music']])
            ->render();
    }

    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Tabs::widget()->render());
    }

    public function testSize(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs is-large">
        <ul>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Tabs::widget()
            ->size(Tabs::SIZE_LARGE)
            ->render());
    }

    public function testStyle(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs is-toggle is-toggle-rounded">
        <ul>
        </ul>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Tabs::widget()
            ->style(Tabs::STYLE_TOGGLE_ROUNDED)
            ->render());
    }

    public function testTabsContent(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li class="is-active"><a href="#l1-tabs-c0">Pictures</a></li>
        <li><a href="#l1-tabs-c1">Music</a></li>
        <li><a href="#l1-tabs-c2">Videos</a></li>
        <li><a href="#l1-tabs-c3">Documents</a></li>
        </ul>
        </div>
        <div class="tabs-content">
        <div id="w1-tabs-c0" class="is-active">Some text about pictures</div>
        <div id="w1-tabs-c1">Some text about music</div>
        <div id="w1-tabs-c2">Some text about videos</div>
        <div id="w1-tabs-c3">Some text about documents</div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->items([
                    [
                        'label' => 'Pictures',
                        'active' => true,
                        'content' => 'Some text about pictures',
                        'contentAttributes' => [
                            'class' => 'is-active',
                        ],
                    ],
                    ['label' => 'Music', 'content' => 'Some text about music'],
                    ['label' => 'Videos', 'content' => 'Some text about videos'],
                    ['label' => 'Documents', 'content' => 'Some text about documents'],
                ])
                ->render()
        );
    }

    public function testTabsContentAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-tabs" class="tabs">
        <ul>
        <li><a href="#l1-tabs-c0">Music</a></li>
        </ul>
        </div>
        <div class="text-center tabs-content">
        <div id="w1-tabs-c0">Some text about music</div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Tabs::widget()
                ->tabsContentAttributes(['class' => 'text-center'])
                ->items([
                    ['label' => 'Music', 'content' => 'Some text about music'],
                ])
                ->render()
        );
    }
}
