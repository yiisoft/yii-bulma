<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\ProgressBar;

final class ProgressBarTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="has-background-black progress" max="100"></progress>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ProgressBar::widget()
                ->attributes(['class' => 'has-background-black'])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testColor(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress is-primary" max="100"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->color(ProgressBar::COLOR_PRIMARY)
            ->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExceptionColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "is-primary", "is-link", "is-info", "is-success", "is-warning", "is-danger", "is-dark".'
        );
        ProgressBar::widget()
            ->color('is-non-existent')
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExceptionSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid size. Valid values are: "is-small", "is-medium", "is-large".');
        ProgressBar::widget()
            ->size('is-non-existent')
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImmutability(): void
    {
        $widget = ProgressBar::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(ProgressBar::class));
        $this->assertNotSame($widget, $widget->color('is-primary'));
        $this->assertNotSame($widget, $widget->id(ProgressBar::class));
        $this->assertNotSame($widget, $widget->maxValue(100));
        $this->assertNotSame($widget, $widget->size('is-small'));
        $this->assertNotSame($widget, $widget->value(100));
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testMax(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress" max="50"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->maxValue(50)
            ->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testMaxException(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid max value. It must be between 0 and 100.');
        ProgressBar::widget()
            ->maxValue(150)
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testPercent(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress" value="75" max="100">75%</progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->value(75)
            ->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testSize(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress is-large" max="100"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->size(ProgressBar::SIZE_LARGE)
            ->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress" max="100"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testValueExceptionWithLessThanZero(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value. It must be between 0 and 100.');
        ProgressBar::widget()
            ->value(-1)
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testValueExceptionWithGreaterZero(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value. It must be between 0 and 100.');
        ProgressBar::widget()
            ->value(150)
            ->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testWithZeroValues(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->value(0)
            ->maxValue(0)
            ->render());
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testWithNullValues(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <progress id="w1-progressbar" class="progress"></progress>
        HTML;
        $this->assertEqualsWithoutLE($expected, ProgressBar::widget()
            ->value(null)
            ->maxValue(null)
            ->render());
    }
}
