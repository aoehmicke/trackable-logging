<?php

namespace App\Tests\__helper;

class RegularExpressionHelper
{
    public static function UuidPattern(): string
    {
        return '/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/';
    }
}