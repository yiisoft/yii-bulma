<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Exception;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetConverter;
use Yiisoft\Assets\AssetConverterInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Assets\AssetPublisherInterface;
use Yiisoft\Di\Container;
use Yiisoft\Factory\Definitions\Reference;
use Yiisoft\Files\FileHelper;
use Yiisoft\Widget\WidgetFactory;

abstract class TestCase extends BaseTestCase
{
    private Aliases $aliases;
    private ContainerInterface $container;
    protected AssetManager $assetManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container($this->config());

        WidgetFactory::initialize($this->container, []);

        $this->aliases = $this->container->get(Aliases::class);

        /* Set aliases tests */
        $this->aliases->set('@assets', __DIR__ . '/data');
        $this->aliases->set('@assetsUrl', '/');
        $this->aliases->set('@npm', dirname(__DIR__) . '/node_modules');

        $this->assetManager = $this->container->get(AssetManager::class);
    }

    protected function tearDown(): void
    {
        $this->removeAssets('@assets');

        unset($this->aliases, $this->container);

        parent::tearDown();
    }

    /**
     * Asserting two strings equality ignoring line endings.
     *
     * @param string $expected
     * @param string $actual
     * @param string $message
     */
    protected function assertEqualsWithoutLE(string $expected, string $actual, string $message = ''): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);
        self::assertEquals($expected, $actual, $message);
    }

    private function removeAssets(string $basePath): void
    {
        $handle = opendir($dir = $this->aliases->get($basePath));

        if ($handle === false) {
            throw new Exception("Unable to open directory: $dir");
        }

        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..' || $file === '.gitignore') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                FileHelper::removeDirectory($path);
            } else {
                FileHelper::unlink($path);
            }
        }

        closedir($handle);
    }

    private function config(): array
    {
        return [
            Aliases::class => [
                '__class' => Aliases::class,
            ],

            LoggerInterface::class => NullLogger::class,

            AssetConverterInterface::class => [
                '__class' => AssetConverter::class,
                '__construct()' => [
                    Reference::to(Aliases::class),
                    Reference::to(LoggerInterface::class),
                ],
            ],

            AssetPublisherInterface::class => [
                '__class' => AssetPublisher::class,
                '__construct()' => [
                    Reference::to(Aliases::class),
                ],
            ],

            AssetManager::class => static function (ContainerInterface $container) {
                $assetManager = new AssetManager($container->get(LoggerInterface::class));

                $assetManager->setConverter($container->get(AssetConverterInterface::class));
                $assetManager->setPublisher($container->get(AssetPublisherInterface::class));

                return $assetManager;
            },
        ];
    }
}
