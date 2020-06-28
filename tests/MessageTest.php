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

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageAutoIdPrefix(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->autoIdPrefix('yii')
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->render();

        $expectedHtml = <<<HTML
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
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }


    public function testMessageHeaderColor(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->headerColor('is-success')
            ->render();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageOptions(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->options(['class' => 'has-text-justified'])
            ->render();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageOptionsBody(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->optionsBody(['class' => 'has-text-justified'])
            ->render();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageOptionsCloseButton(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->optionsCloseButton(['class' => 'btn'])
            ->render();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }


    public function testMessageOptionsHeader(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->optionsHeader(['class' => 'has-text-justified'])
            ->render();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageId(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->id('testMe')
            ->render();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageSize(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->size('is-large')
            ->render();

        $expectedHtml = <<<HTML
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

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageWithoutCloseButton(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->withoutCloseButton(true)
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-message" class="message is-dark">
<div class="message-header">
Very important
</div>
<div class="message-body">
<strong>Holy guacamole!</strong> You should check in on some of those fields below.
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testMessageWithoutHeader(): void
    {
        Message::counter(0);

        $html = Message::widget()
            ->headerMessage('Very important')
            ->body('<strong>Holy guacamole!</strong> You should check in on some of those fields below.')
            ->withoutHeader(false)
            ->render();

        $expectedHtml = <<<HTML
<div id="w1-message" class="message is-dark">
<div class="message-body">
<strong>Holy guacamole!</strong> You should check in on some of those fields below.
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
