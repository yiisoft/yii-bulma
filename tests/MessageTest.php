<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\Message;

final class MessageTest extends TestCase
{
    public function testMessage(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->render();
        $expected = <<<'HTML'
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageAutoIdPrefix(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->autoIdPrefix('yii')
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->render();
        $expected = <<<'HTML'
        <div id="yii1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageHeaderColor(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->headerColor('is-success')
            ->render();
        $expected = <<<'HTML'
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageOptions(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->options(['class' => 'has-text-justified'])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-message" class="message has-text-justified is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageOptionsBody(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->bodyOptions(['class' => 'has-text-justified'])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body has-text-justified">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageOptionsCloseButton(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->closeButtonOptions(['class' => 'btn'])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete btn"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageOptionsHeader(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->headerOptions(['class' => 'has-text-justified'])
            ->render();
        $expected = <<<'HTML'
        <div id="w1-message" class="message is-dark">
        <div class="message-header has-text-justified">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageId(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->id('testMe')
            ->render();
        $expected = <<<'HTML'
        <div id="testMe-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageSize(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->size('is-large')
            ->render();
        $expected = <<<'HTML'
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
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageWithoutCloseButton(): void
    {
        Message::counter(0);
        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->closeButton()
            ->render();
        $expected = <<<'HTML'
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        Very important
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testMessageWithoutHeader(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->withoutHeader()
            ->render();
        $expected = <<<'HTML'
        <div id="w1-message" class="message is-dark">
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }

    public function testEncodeTags(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->encodeTags()
            ->render();
        $expected = <<<'HTML'
        <div id="w1-message" class="message is-dark">
        <div class="message-header">
        <p>Very important</p>
        <button type="button" class="delete">&lt;span aria-hidden="true"&gt;&amp;times;&lt;/span&gt;</button>
        </div>
        <div class="message-body">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        </div>
        </div>
        HTML;
        $this->assertEqualsWithoutLE($expected, $html);
    }
}
