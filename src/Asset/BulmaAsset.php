<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

final class BulmaAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/bulma';

    public array $css = [
        'css/bulma.css',
    ];

    public function __construct()
    {
        $this->publishOptions = [
            'filter' => (new PathMatcher())->only('css/bulma.css'),
        ];
    }
}
