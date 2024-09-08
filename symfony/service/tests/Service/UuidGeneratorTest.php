<?php

namespace App\Tests\Service;

use App\Tests\__helper\RegularExpressionHelper;
use App\Service\UuidGenerator;
use PHPUnit\Framework\TestCase;

class UuidGeneratorTest extends TestCase
{
    public function testGenerate(): void
    {
        $uuidGenerator = new UuidGenerator();

        self::assertMatchesRegularExpression(RegularExpressionHelper::UuidPattern(), $uuidGenerator->generate());
    }
}