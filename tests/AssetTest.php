<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaHelpersAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaJsAsset;
use Yiisoft\Yii\Bulma\Asset\FilePluginAsset;
use Yiisoft\Yii\Bulma\Asset\MessagePluginAsset;

final class AssetTest extends TestCase
{
    /**
     * @return array
     */
    public function registerDataProvider(): array
    {
        return [
            [
                'Css',
                BulmaAsset::class,
            ],
            [
                'Css',
                BulmaHelpersAsset::class,
            ],
            [
                'Js',
                BulmaJsAsset::class,
            ],
            [
                'Js',
                FilePluginAsset::class,
            ],
            [
                'Js',
                MessagePluginAsset::class,
            ],
        ];
    }

    /**
     * @dataProvider registerDataProvider
     *
     * @param string $type
     * @param string $asset
     * @param string|null $depend
     */
    public function testAssetRegister(string $type, string $asset, ?string $depend = null): void
    {
        $publisher = $this->assetManager->getPublisher();

        $bundle = new $asset();

        if ($depend !== null) {
            $depend = new $depend();
        }

        self::assertEmpty($this->assetManager->getAssetBundles());

        $this->assetManager->register([$asset]);

        if ($type === 'Css') {
            if ($depend !== null) {
                $dependUrl = $publisher->getPublishedUrl($depend->sourcePath) . '/' . $depend->css[0];
                self::assertEquals($dependUrl, $this->assetManager->getCssFiles()[$dependUrl]['url']);
            } else {
                $bundleUrl = $publisher->getPublishedUrl($bundle->sourcePath) . '/' . $bundle->css[0];
                self::assertEquals($bundleUrl, $this->assetManager->getCssFiles()[$bundleUrl]['url']);
            }
        }

        if ($type === 'Js') {
            if ($depend !== null) {
                $dependUrl = $publisher->getPublishedUrl($depend->sourcePath) . '/' . $depend->js[0];
                self::assertEquals($dependUrl, $this->assetManager->getJsFiles()[$dependUrl]['url']);
            } else {
                $bundleUrl = $publisher->getPublishedUrl($bundle->sourcePath) . '/' . $bundle->js[0];
                self::assertEquals($bundleUrl, $this->assetManager->getJsFiles()[$bundleUrl]['url']);
            }
        }
    }
}
