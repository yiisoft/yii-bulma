<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Asset;

use Yiisoft\Assets\AssetBundle;

final class BulmaAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/bulma/';

    /** @psalm-suppress NonInvariantDocblockPropertyType */
    public array $css = [
        'css/bulma.css',
    ];

    /** @psalm-suppress NonInvariantDocblockPropertyType */
    public array $publishOptions = [
        'only' => [
            'css/bulma.css',
        ],
    ];
}
