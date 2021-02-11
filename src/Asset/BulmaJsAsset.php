<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Asset;

use Yiisoft\Assets\AssetBundle;

final class BulmaJsAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/vizuaalog--bulmajs';

    /** @psalm-suppress NonInvariantDocblockPropertyType */
    public array $js = [
        'dist/bulma.js',
    ];

    /** @psalm-suppress NonInvariantDocblockPropertyType */
    public array $publishOptions = [
        'only' => [
            'dist/bulma.js',
        ],
    ];
}
