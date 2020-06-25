<?php

declare(strict_types=1);

use Yiisoft\Yii\Bulma\Asset\MessageAsset;

return [
    'aliases' => [
        '@bulma' => dirname(__DIR__),
        '@bulmaAsset' => '@bulma/resources/assets',
        '@assets' => '@bulma/tests/data',
        '@assetsUrl' => '/',
        '@npm' => '@bulma/node_modules'
    ],
];
