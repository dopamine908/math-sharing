<?php

namespace App\Helpers;

use Mockery;

class TestHelper
{
    public static function createMock(mixed $targetClass): mixed
    {
        $mockTargetClass = Mockery::mock($targetClass);
        app()->instance($targetClass, $mockTargetClass);
        return $mockTargetClass;
    }
}
