<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

final class DropdownAsset extends AssetBundle
{
    public ?string $basePath = '@assets';
    public ?string $baseUrl = '@assetsUrl';
    public ?string $sourcePath = '@npm/vizuaalog--bulmajs';

    public array $js = [
        'dist/dropdown.js',
    ];

    public function __construct()
    {
        $this->publishOptions = [
            'filter' => (new PathMatcher())->only('dist/dropdown.js'),
        ];
    }
}
