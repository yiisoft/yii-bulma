<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

final class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testParams(): void
    {
        $params = require dirname(__DIR__) . '/config/params.php';

        $this->assertIsArray($params['yiisoft/form']['configs']['bulma'] ?? null);
    }
}
