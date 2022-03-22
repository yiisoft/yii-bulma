<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Asset;

use Yiisoft\Assets\AssetBundle;

final class PanelAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/vizuaalog--bulmajs';

    public array $js = [
        'dist/panel.js',
    ];

    public array $publishOptions = [
        'only' => [
            'dist/panel.js',
        ],
    ];
}
