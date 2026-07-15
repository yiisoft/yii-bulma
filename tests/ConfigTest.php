<?php

declare(strict_types=1);

namespace Yiisoft\Yii\Bulma\Tests;

use PHPUnit\Framework\TestCase;

use function dirname;

final class ConfigTest extends TestCase
{
    public function testParams(): void
    {
        $params = require dirname(__DIR__) . '/config/params.php';

        $this->assertIsArray($params['yiisoft/form']['configs']['bulma'] ?? null);
    }
}
