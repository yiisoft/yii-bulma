<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Container\ContainerInterface;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Aliases\Aliases;
use Yiisoft\Composer\Config\Builder;
use Yiisoft\Files\FileHelper;
use Yiisoft\Di\Container;

abstract class TestCase extends BaseTestCase
{
    private Aliases $aliases;
    private ContainerInterface $container;
    protected AssetManager $assetManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = new Container(
            require Builder::path('web'),
            require Builder::path('providers')
        );

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
     *
     * @return void
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
            throw new \Exception("Unable to open directory: $dir");
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
}
