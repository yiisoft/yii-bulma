<?php

declare(strict_types=1);

use Yiisoft\Form\Widget\Field;

/** @var array $params */

if ($params['yiisoft/form']['bulma']['enabled'] === true) {
    return [
        Field::class => [
            'containerClass()' => [$params['yiisoft/form']['bulma']['containerClass']],
            'errorClass()' => [$params['yiisoft/form']['bulma']['errorClass']],
            'hintClass()' => [$params['yiisoft/form']['bulma']['hintClass']],
            'inputClass()' => [$params['yiisoft/form']['bulma']['inputClass']],
            'invalidClass()' => [$params['yiisoft/form']['bulma']['invalidClass']],
            'labelClass()' => [$params['yiisoft/form']['bulma']['labelClass']],
            'template()' => [$params['yiisoft/form']['bulma']['template']],
            'validClass()' => [$params['yiisoft/form']['bulma']['validClass']],
        ],
    ];
}
