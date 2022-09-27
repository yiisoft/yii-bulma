<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use Yiisoft\Test\Support\Container\SimpleContainer;
use Yiisoft\Widget\WidgetFactory;

abstract class TestCase extends BaseTestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new SimpleContainer();
        WidgetFactory::initialize($this->container, []);
    }

    protected function tearDown(): void
    {
        unset($this->container);

        parent::tearDown();
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

    /**
     * Sets an inaccessible object property to a designated value.
     *
     * @param $value
     * @param bool $revoke whether to make property inaccessible after setting
     */
    protected function setInaccessibleProperty(object $object, string $propertyName, $value, bool $revoke = true): void
    {
        $class = new ReflectionClass($object);

        while (!$class->hasProperty($propertyName)) {
            $class = $class->getParentClass();
        }

        $property = $class->getProperty($propertyName);

        $property->setAccessible(true);

        $property->setValue($object, $value);

        if ($revoke) {
            $property->setAccessible(false);
        }
    }
}

namespace Yiisoft\Html;

function hrtime(bool $getAsNumber = false): void
{
}
