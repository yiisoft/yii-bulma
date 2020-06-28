<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Files\FileHelper;
use Yiisoft\Di\Container;
use Yiisoft\Widget\Widget;
use Yiisoft\Widget\WidgetFactory;

abstract class TestCase extends BaseTestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container(
            require Builder::path('web'),
            require Builder::path('providers')
        );
    }

    protected function tearDown(): void
    {
        unset($this->container);

        parent::tearDown();
    }

    /**
     * Asserting two strings equality ignoring line endings.
     *
     * @param string $expected
     * @param string $actual
     * @param string $message
     *
     * @return void
     */
    protected function assertEqualsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);
        $this->assertEquals($expected, $actual, $message);
    }
}
