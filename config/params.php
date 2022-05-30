<?php

declare(strict_types=1);

/**
 * For use bulma style as default in Yii Forms set `$params['yiisoft/form']['defaultConfig']` to `bulma`.
 *
 * @link https://bulma.io/documentation/form/general/#complete-form-example
 */

return [
    'yiisoft/form' => [
        'configs' => [
            'bulma' => [
                'containerClass' => 'field',
                'inputClass' => 'input',
                'invalidClass' => 'has-background-danger',
                'validClass' => 'has-background-success',
                'template' => "{label}<div class=\"control\">\n{input}</div>\n{hint}\n{error}",
                'labelClass' => 'label',
                'errorClass' => 'has-text-danger is-italic',
                'hintClass' => 'help',
            ],
        ],
    ],
];
