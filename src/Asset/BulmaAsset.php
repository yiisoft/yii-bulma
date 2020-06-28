<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Asset;

use Yiisoft\Assets\AssetBundle;

final class BulmaAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/bulma/css';

    public array $css = [
        'bulma.css',
    ];

    public array $publishOptions = [
        'only' => [
            'bulma.css',
        ],
    ];
}
