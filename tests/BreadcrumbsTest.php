<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Breadcrumbs;

final class BreadcrumbsTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testAriaLabel(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="main">
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()->ariaLabel('main')->items([['label' => 'About', 'url' => '/about']])->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs" autofocus>
        <ul>
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->attributes(['autofocus' => true])
                ->homeItem(['label' => 'Index', 'url' => '/index'])
                ->items([['label' => 'About', 'url' => '/about']])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testEncodeLabels(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">&lt;span&gt;&lt;i class =fas fas-profile&gt;&lt;/i&gt;Setting Profile&lt;/span&gt;</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->encode(true)
                ->items([
                    [
                        'label' => '<span><i class =fas fas-profile></i>Setting Profile</span>',
                        'url' => '/about',
                    ],
                ])->render(),
        );

        $expected = <<<HTML
        <nav id="w2-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about"><span><i class =fas fas-profile></i>Setting Profile</span></a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->encode(false)
                ->items([
                    [
                        'label' => '<span><i class =fas fas-profile></i>Setting Profile</span>',
                        'url' => '/about',
                    ],
                ])->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHomeItemThrowExceptionForEmptyArray(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The home item cannot be an empty array. To disable rendering of the home item, specify null.',
        );
        Breadcrumbs::widget()->homeItem([]);
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHomeLink(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->homeItem(['label' => 'Index', 'url' => '/index'])
                ->items([['label' => 'About', 'url' => '/about']])
                ->render(),
        );

        $expected = <<<HTML
        <nav id="w2-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li>Index</li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->homeItem(['label' => 'Index'])
                ->items([['label' => 'About', 'url' => '/about']])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     *
     * @link https://bulma.io/documentation/components/breadcrumb/#icons
     */
    public function testIcons(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="is-centered breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/"><span class="icon is-small"><i class="fas fa-home" aria-hidden="true"></i></span><span>Bulma</span></a></li>
        <li><a href="/docs"><span class="icon is-small"><i class="fas fa-book" aria-hidden="true"></i></span><span>Documentation</span></a></li>
        <li><a href="/components"><span class="icon is-small"><i class="fas fa-puzzle-piece" aria-hidden="true"></i></span><span>Components</span></a></li>
        <li class="is-active"><a aria-current="page"><span class="icon is-small"><i class="fas fa-thumbs-up" aria-hidden="true"></i></span><span>Breadcrumb</span></a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->attributes(['class' => 'is-centered'])
                ->homeItem(
                    [
                        'label' => 'Bulma',
                        'url' => '/',
                        'icon' => 'fas fa-home',
                        'iconAttributes' => ['class' => 'icon is-small'],
                    ]
                )
                ->items(
                    [
                        [
                            'label' => 'Documentation',
                            'url' => '/docs',
                            'icon' => 'fas fa-book',
                            'iconAttributes' => ['class' => 'icon is-small'],
                        ],
                        [
                            'label' => 'Components',
                            'url' => '/components',
                            'icon' => 'fas fa-puzzle-piece',
                            'iconAttributes' => ['class' => 'icon is-small'],
                        ],
                        [
                            'label' => 'Breadcrumb',
                            'icon' => 'fas fa-thumbs-up',
                            'iconAttributes' => ['class' => 'icon is-small'],
                        ],
                    ]
                )
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImmutability(): void
    {
        $widget = Breadcrumbs::widget();

        $this->assertNotSame($widget, $widget->activeItemTemplate(''));
        $this->assertNotSame($widget, $widget->ariaLabel(''));
        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Breadcrumbs::class));
        $this->assertNotSame($widget, $widget->encode(false));
        $this->assertNotSame($widget, $widget->homeItem(null));
        $this->assertNotSame($widget, $widget->id(Breadcrumbs::class));
        $this->assertNotSame($widget, $widget->items([]));
        $this->assertNotSame($widget, $widget->itemsAttributes([]));
        $this->assertNotSame($widget, $widget->itemTemplate(''));
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemsAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul class="testMe">
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->homeItem(['label' => 'Index', 'url' => '/index'])
                ->items([['label' => 'About', 'url' => '/about']])
                ->itemsAttributes(['class' => 'testMe'])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemTemplate(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <div><a href="/index">Index</a></div>
        <div><a href="/about">About</a></div>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->homeItem(['label' => 'Index', 'url' => '/index'])
                ->itemTemplate("<div>{link}</div>\n")
                ->items([['label' => 'About', 'url' => '/about']])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testItemTemplateActive(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->homeItem(['label' => 'Index', 'url' => '/index'])
                ->activeItemTemplate("<li class=\"active\"><a aria-current=\"page\">{label}</a></li>\n")
                ->items([['label' => 'About', 'url' => '/about']])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testLinksEmpty(): void
    {
        $this->assertempty(Breadcrumbs::widget()->items([])->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testLinksEmptyUrl(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li class="is-active"><a aria-current="page">about</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, Breadcrumbs::widget()->items(['label' => 'about'])->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testLinksException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" element is required for each link.');
        Breadcrumbs::widget()
            ->items([['url' => '/about', 'template' => '<div>{link}</div>']])
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testLinksTemplate(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <div><a href="/about">about</a></div>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->items([['label' => 'about', 'url' => '/about', 'template' => "<div>{link}</div>\n"]])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     *
     * @link https://bulma.io/documentation/components/breadcrumb/
     */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/bulma">Bulma</a></li>
        <li><a href="/documentation">Documentation</a></li>
        <li><a href="/components">Components</a></li>
        <li class="is-active"><a aria-current="page">Breadcrumb</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->homeItem(['label' => 'Bulma', 'url' => '/bulma'])
                ->items(
                    [
                        ['label' => 'Documentation', 'url' => '/documentation'],
                        ['label' => 'Components', 'url' => '/components'],
                        ['label' => 'Breadcrumb'],
                    ],
                )->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testWithoutHomeItem(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Breadcrumbs::widget()
                ->homeItem(null)
                ->items([['label' => 'About', 'url' => '/about']])
                ->render(),
        );
    }
}
