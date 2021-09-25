<?php

declare(strict_types=1);

/**
 * @link https://bulma.io/documentation/form/general/#complete-form-example
 */
return [
    'yiisoft/form' => [
        'bulma' => [
            'enabled' => true,
            'fieldConfig' => [
                'containerClass' => 'field',
                'errorClass' => 'has-text-danger is-italic',
                'hintClass' => 'help',
                'inputClass' => 'input',
                'invalidClass' => 'has-background-danger',
                'labelClass' => 'label',
                'template' => "{label}<div class=\"control\">\n{input}</div>\n{hint}\n{error}",
                'validClass' => 'has-background-success',
            ],
        ],
    ],
];
