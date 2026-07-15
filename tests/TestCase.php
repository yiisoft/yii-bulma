<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use Yiisoft\Html\IdGenerator;
use Yiisoft\Test\Support\Container\SimpleContainer;
use Yiisoft\Widget\WidgetFactory;

abstract class TestCase extends BaseTestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new SimpleContainer();
        WidgetFactory::initialize($this->container);

        IdGenerator\disableSeed();
        IdGenerator\reset();
    }

    protected function tearDown(): void
    {
        unset($this->container);

        parent::tearDown();

        IdGenerator\enableSeed();
    }

    /**
     * Asserting two strings equality ignoring line endings.
     */
    protected function assertEqualsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);
        self::assertEquals($expected, $actual, $message);
    }
}
