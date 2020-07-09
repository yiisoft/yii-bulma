<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Yii\Bulma\Asset\BulmaAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaHelpersAsset;
use Yiisoft\Yii\Bulma\Asset\BulmaJsAsset;
use Yiisoft\Yii\Bulma\Asset\PlugInFileAsset;
use Yiisoft\Yii\Bulma\Asset\PlugInMessageAsset;

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
                PlugInFileAsset::class,
            ],
            [
                'Js',
                PlugInMessageAsset::class,
            ],
        ];
    }

    /**
     * @dataProvider registerDataProvider
     *
     * @param string $type
     * @param string $bundle
     * @param string $depend
     */
    public function testAssetRegister(string $type, string $asset, ?string $depend = null): void
    {
        $publisher = $this->assetManager->getPublisher();

        $bundle = new $asset();

        if ($depend !== null) {
            $depend = new $depend();
        }

        $this->assertEmpty($this->assetManager->getAssetBundles());

        $this->assetManager->register([$asset]);

        if ($depend !== null && $type === 'Css') {
            $dependUrl = $publisher->getPublishedUrl($depend->sourcePath) . '/' . $depend->css[0];
            $this->assertEquals($dependUrl, $this->assetManager->getCssFiles()[$dependUrl]['url']);
        } elseif ($type === 'Css') {
            $bundleUrl = $publisher->getPublishedUrl($bundle->sourcePath) . '/' . $bundle->css[0];
            $this->assertEquals($bundleUrl, $this->assetManager->getCssFiles()[$bundleUrl]['url']);
        }

        if ($depend !== null && $type === 'Js') {
            $dependUrl = $publisher->getPublishedUrl($depend->sourcePath) . '/' . $depend->js[0];
            $this->assertEquals($dependUrl, $this->assetManager->getJsFiles()[$dependUrl]['url']);
        } elseif ($type === 'Js') {
            $bundleUrl = $publisher->getPublishedUrl($bundle->sourcePath) . '/' . $bundle->js[0];
            $this->assertEquals($bundleUrl, $this->assetManager->getJsFiles()[$bundleUrl]['url']);
        }
    }
}
