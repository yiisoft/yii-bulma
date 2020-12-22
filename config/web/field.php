<?php

declare(strict_types=1);

use Composer\InstalledVersions;
use Yiisoft\Form\Widget\Field;

if (InstalledVersions::isInstalled('yiisoft/form') && $params['yiisoft/form']['bulma']['enabled'] === true) {
    return [
        Field::class => fn () => Field::Widget($params['yiisoft/form']['bulma']['fieldConfig']),
    ];
}
