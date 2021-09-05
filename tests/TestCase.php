<?php

namespace Tests;

use Codeception\Specify;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Specify;

    public function createMockeryMock(mixed $targetClass): mixed
    {
        $mockTargetClass = Mockery::mock($targetClass);
        app()->instance($targetClass, $mockTargetClass);
        return $mockTargetClass;
    }

    public function createMockToContainer(mixed $targetClass): mixed
    {
        return $this->createMockeryMock($targetClass);
    }

    public function createStubToContainer(mixed $targetClass): mixed
    {
        return $this->createMockeryMock($targetClass);
    }
}
