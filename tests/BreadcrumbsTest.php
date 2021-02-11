<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Yii\Bulma\Breadcrumbs;

final class BreadcrumbsTest extends TestCase
{
    public function testBreadcrumbs(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()->items([['label' => 'About', 'url' => '/about']])->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsEncodeLabels(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->items(
                [
                    [
                        'label' => '<span><i class =fas fas-profile></i>Setting Profile</span>',
                        'url' => '/about',
                    ],
                ],
            )->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">&lt;span&gt;&lt;i class =fas fas-profile&gt;&lt;/i&gt;Setting Profile&lt;/span&gt;</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        $html = Breadcrumbs::widget()
            ->withoutEncodeLabels()
            ->items(
                [
                    [
                        'label' => '<span><i class =fas fas-profile></i>Setting Profile</span>',
                        'url' => '/about',
                    ],
                ],
            )->render();
        $expected = <<<'HTML'
        <nav id="w2-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about"><span><i class =fas fas-profile></i>Setting Profile</span></a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsHomeLink(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->homeItem(['label' => 'Index', 'url' => '/index'])
            ->items([['label' => 'About', 'url' => '/about']])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);

        $html = Breadcrumbs::widget()
            ->homeItem(['label' => 'Index'])
            ->items([['label' => 'About', 'url' => '/about']])
            ->render();
        $expected = <<<'HTML'
        <nav id="w2-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li>Index</li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsItemTemplate(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->homeItem(['label' => 'Index', 'url' => '/index'])
            ->itemTemplate("<div>{link}</div>\n")
            ->items([['label' => 'About', 'url' => '/about']])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <div><a href="/index">Index</a></div>
        <div><a href="/about">About</a></div>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsItemTemplateActive(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->homeItem(['label' => 'Index', 'url' => '/index'])
            ->activeItemTemplate("<li class=\"active\"><a aria-current=\"page\">{label}</li>\n")
            ->items([['label' => 'About', 'url' => '/about']])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsLinksEmpty(): void
    {
        $html = Breadcrumbs::widget()->items([])->render();
        $this->assertempty($html);
    }

    public function testBreadcrumbsLinksEmptyUrl(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()->items(['label' => 'about'])->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li class="is-active"><a aria-current="page">about</li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsLinksTemplate(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->items([['label' => 'about', 'url' => '/about', 'template' => "<div>{link}</div>\n"]])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <div><a href="/about">about</a></div>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsLinksException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The "label" element is required for each link.');
        $html = Breadcrumbs::widget()
            ->items([['url' => '/about', 'template' => '<div>{link}</div>']])
            ->render();
    }

    public function testBreadcrumbsOptions(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->homeItem(['label' => 'Index', 'url' => '/index'])
            ->items([['label' => 'About', 'url' => '/about']])
            ->options(['class' => 'is-centered'])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb is-centered" aria-label="breadcrumbs">
        <ul>
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsOptionsItems(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->homeItem(['label' => 'Index', 'url' => '/index'])
            ->items([['label' => 'About', 'url' => '/about']])
            ->itemsOptions(['class' => 'testMe'])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul class="testMe">
        <li><a href="/index">Index</a></li>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsIcons(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->homeItem(
                [
                    'label' => 'Index',
                    'url' => '/index',
                    'icon' => 'fas fa-home',
                    'iconOptions' => ['class' => 'icon'],
                ]
            )
            ->items(
                [
                    [
                        'label' => 'About',
                        'url' => '/about',
                        'icon' => 'fas fa-thumbs-up',
                        'iconOptions' => ['class' => 'icon'],
                    ],
                ]
            )
            ->options(['class' => 'is-centered'])
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb is-centered" aria-label="breadcrumbs">
        <ul>
        <li><span class="icon"><i class="fas fa-home"></i></span><a href="/index">Index</a></li>
        <li><span class="icon"><i class="fas fa-thumbs-up"></i></span><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testBreadcrumbsWithoutHomeItem(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->items([['label' => 'About', 'url' => '/about']])
            ->withoutHomeItem()
            ->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/about">About</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testEncodeTags(): void
    {
        Breadcrumbs::counter(0);

        $html = Breadcrumbs::widget()
            ->withoutEncodeLabels()
            ->encodeTags()
            ->items(
                [
                    [
                        'label' => '<span><i class =fas fas-profile></i>Setting Profile</span>',
                        'url' => '/about',
                    ],
                ],
            )->render();
        $expected = <<<'HTML'
        <nav id="w1-breadcrumbs" class="breadcrumb" aria-label="breadcrumbs">
        <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">&lt;span&gt;&lt;i class =fas fas-profile&gt;&lt;/i&gt;Setting Profile&lt;/span&gt;</a></li>
        </ul>
        </nav>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
