<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Div;
use Yiisoft\Yii\Bulma\Modal;

final class ModalTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testBackgroundClass(): void
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
            Modal::widget()->backgroundClass('test-class')->begin() . Modal::end(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testButtonClass(): void
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
            Modal::widget()->buttonClass('test-class')->begin() . Modal::end(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->closeButtonSize(Modal::SIZE_LARGE)->begin() . Modal::end(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testContentClass(): void
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
            Modal::widget()->contentClass('test-class')->begin() . Modal::end(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExceptionToggleButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid size. Valid values are: "is-small", "is-medium", "is-large".');
        Modal::widget()->toggleButtonSize('is-non-existent');
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExceptionToggleButtonColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "is-primary", "is-link", "is-info", "is-success", "is-warning", "is-danger", "is-dark".'
        );
        Modal::widget()->toggleButtonColor('is-non-existent');
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testExceptionToggleCloseButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid size. Valid values are: "is-small", "is-medium", "is-large".');
        Modal::widget()->closeButtonSize('is-non-existent');
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImmutability(): void
    {
        $widget = Modal::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Modal::class));
        $this->assertNotSame($widget, $widget->backgroundClass(''));
        $this->assertNotSame($widget, $widget->buttonClass(''));
        $this->assertNotSame($widget, $widget->closeButtonAttributes([]));
        $this->assertNotSame($widget, $widget->closeButtonSize('is-small'));
        $this->assertNotSame($widget, $widget->contentAttributes([]));
        $this->assertNotSame($widget, $widget->contentClass(''));
        $this->assertNotSame($widget, $widget->id(Modal::class));
        $this->assertNotSame($widget, $widget->modalClass(''));
        $this->assertNotSame($widget, $widget->toggleButtonattributes([]));
        $this->assertNotSame($widget, $widget->toggleButtonColor(Modal::COLOR_PRIMARY));
        $this->assertNotSame($widget, $widget->toggleButtonLabel(''));
        $this->assertNotSame($widget, $widget->toggleButtonSize(Modal::SIZE_SMALL));
        $this->assertNotSame($widget, $widget->withoutCloseButton(false));
        $this->assertNotSame($widget, $widget->withoutToggleButton(false));
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->toggleButtonColor(Modal::COLOR_INFO)->begin() . Modal::end(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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
        $this->assertEqualsWithoutLE(
            $expected,
            Modal::widget()->toggleButtonSize(Modal::SIZE_LARGE)->begin() . Modal::end(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
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
}
