<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use InvalidArgumentException;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Html\Html;
use Yiisoft\Yii\Bulma\Message;

final class MessageTest extends TestCase
{
    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="has-text-justified message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->attributes(['class' => 'has-text-justified'])
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->headerMessage('Very important')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testBodyAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="has-text-justified message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->bodyAttributes(['class' => 'has-text-justified'])
                ->headerMessage('Very important')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testCloseButtonAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="btn delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->closeButtonAttributes(['class' => 'btn'])
                ->headerMessage('Very important')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHeaderAttributes(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark">
        <div class="has-text-justified message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->headerAttributes(['class' => 'has-text-justified'])
                ->headerMessage('Very important')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHeaderColor(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-success">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->headerMessage('Very important')
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->headerColor('is-success')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testHeaderColorException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid color. Valid values are: "is-primary", "is-link", "is-info", "is-success", "is-warning", "is-danger", "is-dark".'
        );
        Message::widget()->headerColor('is-non-existent')->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testId(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="id-tests" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->headerMessage('Very important')
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->id('id-tests')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testImmutability(): void
    {
        $widget = Message::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autoIdPrefix(Message::class));
        $this->assertNotSame($widget, $widget->body(''));
        $this->assertNotSame($widget, $widget->bodyAttributes([]));
        $this->assertNotSame($widget, $widget->bodyCssClass(''));
        $this->assertNotSame($widget, $widget->closeButtonAttributes([]));
        $this->assertNotSame($widget, $widget->headerAttributes([]));
        $this->assertNotSame($widget, $widget->headerColor('is-success'));
        $this->assertNotSame($widget, $widget->headerMessage(''));
        $this->assertNotSame($widget, $widget->id(Message::class));
        $this->assertNotSame($widget, $widget->size('is-small'));
        $this->assertNotSame($widget, $widget->withoutCloseButton(true));
        $this->assertNotSame($widget, $widget->withoutHeader(false));
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRender(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->headerMessage('Very important')
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testRenderWithEncode(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        Holy &amp; guacamole!.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->headerMessage('Very important')
                ->body('Holy & guacamole!.')
                ->encode(true)
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testSize(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark is-large">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete is-large"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->headerMessage('Very important')
                ->size('is-large')
                ->render()
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testSizeException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid size. Valid values are: "is-small", "is-medium", "is-large".');
        Message::widget()->size('is-non-existent')->render();
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testWithoutCloseButton(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark">
        <div class="message-header">Very important</div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->headerMessage('Very important')
                ->withoutCloseButton(true)
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException|InvalidConfigException|NotFoundException|NotInstantiableException
     */
    public function testWithoutHeader(): void
    {
        $this->setInaccessibleProperty(new Html(), 'generateIdCounter', []);
        $expected = <<<HTML
        <div id="w1-message" class="message is-dark">
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE(
            $expected,
            Message::widget()
                ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
                ->headerMessage('Very important')
                ->withoutHeader(true)
                ->render(),
        );
    }
}
