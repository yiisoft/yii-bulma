<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Yii\Bulma\Modal;

final class ModalTest extends TestCase
{
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        <div class="box">Say hello...</div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->begin() .
            Div::tag()->class('box')->content('Say hello...')->render() . PHP_EOL .
            Modal::end(),
        );
    }

    public function testAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="widescreen modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        <div class="box">Say hello...</div>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->attributes(['class' => 'widescreen'])->begin() .
            Div::tag()->class('box')->content('Say hello...') . PHP_EOL .
            Modal::end(),
        );
    }

    public function testWithoutToggleButton(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Modal::widget()->withoutToggleButton(true)->begin() . Modal::end());
    }

    public function testToggleButtonLabel(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Click to open.</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->toggleButtonLabel('Click to open.')->begin() . Modal::end(),
        );
    }

    public function testToggleButtonColor(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="is-info button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Modal::widget()->toggleButtonColor('is-info')->begin() . Modal::end());
    }

    public function testToggleButtonSize(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="is-large button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Modal::widget()->toggleButtonSize('is-large')->begin() . Modal::end());
    }

    public function testWithoutCloseButton(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Modal::widget()->withoutCloseButton(true)->begin() . Modal::end());
    }

    public function testCloseButtonSize(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="is-large modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, Modal::widget()->closeButtonSize('is-large')->begin() . Modal::end());
    }

    public function testCloseButtonAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="some-class modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->closeButtonAttributes(['class' => 'some-class'])->begin() . Modal::end(),
        );
    }

    public function testContentAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="some-class modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->contentAttributes(['class' => 'some-class'])->begin() . Modal::end(),
        );
    }

    public function testExceptionToggleButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Modal::widget()->toggleButtonSize('is-non-existent');
    }

    public function testExceptionToggleButtonColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Modal::widget()->toggleButtonColor('is-non-existent');
    }

    public function testExceptionToggleCloseButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Modal::widget()->closeButtonSize('is-non-existent');
    }

    public function testToggleButtonAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="testMe button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->toggleButtonAttributes(['class' => 'testMe'])->begin() . Modal::end(),
        );
    }

    public function testModalBlackGroundClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="test-class"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->modalBackgroundClass('test-class')->begin() . Modal::end(),
        );
    }

    public function testModalButtonClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="test-class" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->modalButtonClass('test-class')->begin() . Modal::end(),
        );
    }

    public function testModalClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="test-class">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="modal-content">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->modalClass('test-class')->begin() . Modal::end(),
        );
    }

    public function testModalContentClass(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <button class="modal-close" aria-label="close"></button>
        <div class="test-class">
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->modalContentClass('test-class')->begin() . Modal::end(),
        );
    }

    public function testImmutability(): void
    {
        $widget = Modal::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Modal::class));
        $this->assertNotSame($widget, $widget->closeButtonAttributes([]));
        $this->assertNotSame($widget, $widget->closeButtonSize('is-small'));
        $this->assertNotSame($widget, $widget->contentAttributes([]));
        $this->assertNotSame($widget, $widget->id(Modal::class));
        $this->assertNotSame($widget, $widget->modalBackgroundClass(''));
        $this->assertNotSame($widget, $widget->modalButtonClass(''));
        $this->assertNotSame($widget, $widget->modalClass(''));
        $this->assertNotSame($widget, $widget->modalContentClass(''));
        $this->assertNotSame($widget, $widget->toggleButtonattributes([]));
        $this->assertNotSame($widget, $widget->toggleButtonColor('is-primary'));
        $this->assertNotSame($widget, $widget->toggleButtonLabel(''));
        $this->assertNotSame($widget, $widget->toggleButtonSize('is-small'));
        $this->assertNotSame($widget, $widget->withoutCloseButton(false));
        $this->assertNotSame($widget, $widget->withoutToggleButton(false));
    }
}
