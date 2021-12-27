<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Html\Html;
use Yiisoft\Html\Tag\Img;
use Yiisoft\Html\Tag\Button;
use Yiisoft\Html\Tag\P;
use Yiisoft\Yii\Bulma\ModalCard;

final class ModalCardTest extends TestCase
{
    /** @link https://bulmajs.tomerbe.co.uk/docs/0.12/2-core-components/modal/ */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testFooterAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="bg-transparent modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->footerAttributes(['class' => 'bg-transparent'])
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testCardAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="bg-white modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->cardAttributes(['class' => 'bg-white'])
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testToggleButtonLabel(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Launch modal</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->toggleButtonLabel('Launch modal')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testToggleButtonAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" disabled data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->toggleButtonAttributes(['disabled' => true])
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testToggleButtonSize(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="is-large button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->toggleButtonSize(ModalCard::SIZE_LARGE)
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testToggleButtonColor(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="is-success button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->toggleButtonColor(ModalCard::COLOR_SUCCESS)
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testToggleWithoutToggleButton(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->withoutToggleButton(true)
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testCloseButtonSize(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete is-large" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->closeButtonSize(ModalCard::SIZE_LARGE)
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testCloseButtonAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" disabled aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->closeButtonAttributes(['disabled' => true])
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testCloseButtonWithoutCloseButton(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->withoutCloseButton(true)
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testHeaderOptions(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="bg-info modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->headerAttributes(['class' => 'bg-info'])
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testBodyAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="bg-white modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->bodyAttributes(['class' => 'bg-white'])
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testTitleAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="text-info modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="bg-white modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->bodyAttributes(['class' => 'bg-white'])
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->titleAttributes(['class' => 'text-info'])
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testExceptionToggleButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        ModalCard::widget()->toggleButtonSize('is-non-existent')->begin();
    }

    public function testExceptionToggleButtonColor(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "is-primary is-link is-info is-success is-warning is-danger is-dark".'
        );
        ModalCard::widget()->toggleButtonColor('is-non-existent')->begin();
    }

    public function testExceptionToggleCloseButtonSize(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid size. Valid values are: "is-small is-medium is-large".');
        ModalCard::widget()->closeButtonSize('is-non-existent')->begin();
    }

    public function testModalCardAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);

        $expected = <<<HTML
        <button id="w2-button" class="button modal-button" data-target="#w1-modal" aria-haspopup="true">Toggle button</button>
        <div id="w1-modal" class="bg-white modal">
        <div class="modal-background"></div>
        <div class="modal-card">
        <header class="modal-card-head">
        <p class="modal-card-title">Modal title.</p>
        <button class="button delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
        <p class="image is-4by3"><img src="https://bulma.io/images/placeholders/1280x960.png"></p>
        </section>
        <footer class="modal-card-foot">
        <button class="button is-success">Save changes</button>
        <button class="button is-danger is-outline">Cancel</button>
        </footer>
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            ModalCard::widget()
                ->attributes(['class' => 'bg-white'])
                ->footer(
                    Button::tag()->class('button is-success')->content('Save changes') . PHP_EOL .
                    Button::tag()->class('button is-danger is-outline')->content('Cancel')
                )
                ->title('Modal title.')
                ->begin() .
            P::tag()
                ->class('image is-4by3')
                ->content(Img::tag()->src('https://bulma.io/images/placeholders/1280x960.png')) . PHP_EOL .
            ModalCard::end(),
        );
    }

    public function testImmutability(): void
    {
        $widget = ModalCard::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(ModalCard::class));
        $this->assertNotSame($widget, $widget->backgroundClass(''));
        $this->assertNotSame($widget, $widget->bodyAttributes([]));
        $this->assertNotSame($widget, $widget->bodyClass(''));
        $this->assertNotSame($widget, $widget->buttonClass(''));
        $this->assertNotSame($widget, $widget->cardAttributes([]));
        $this->assertNotSame($widget, $widget->closeButtonAttributes([]));
        $this->assertNotSame($widget, $widget->closeButtonSize('is-small'));
        $this->assertNotSame($widget, $widget->contentClass(''));
        $this->assertNotSame($widget, $widget->footClass(''));
        $this->assertNotSame($widget, $widget->footer(''));
        $this->assertNotSame($widget, $widget->footerAttributes([]));
        $this->assertNotSame($widget, $widget->headClass(''));
        $this->assertNotSame($widget, $widget->headerAttributes([]));
        $this->assertNotSame($widget, $widget->id(ModalCard::class));
        $this->assertNotSame($widget, $widget->modalCardClass(''));
        $this->assertNotSame($widget, $widget->title(''));
        $this->assertNotSame($widget, $widget->titleAttributes([]));
        $this->assertNotSame($widget, $widget->titleClass(''));
        $this->assertNotSame($widget, $widget->toggleButtonAttributes([]));
        $this->assertNotSame($widget, $widget->toggleButtonColor('is-primary'));
        $this->assertNotSame($widget, $widget->toggleButtonId(null));
        $this->assertNotSame($widget, $widget->toggleButtonLabel(''));
        $this->assertNotSame($widget, $widget->toggleButtonSize('is-small'));
        $this->assertNotSame($widget, $widget->withoutCloseButton(false));
        $this->assertNotSame($widget, $widget->withoutToggleButton(false));
    }
}
