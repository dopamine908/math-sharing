<?php

namespace Tests;

use Codeception\Specify;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Specify;

    public function createMockeryMock(mixed $targetClass): MockInterface|LegacyMockInterface
    {
        $mockTargetClass = Mockery::mock($targetClass);
        app()->instance($targetClass, $mockTargetClass);
        return $mockTargetClass;
    }

    public function createMockToContainer(mixed $targetClass): MockInterface|LegacyMockInterface
    {
        return $this->createMockeryMock($targetClass);
    }

    public function createStubToContainer(mixed $targetClass): MockInterface|LegacyMockInterface
    {
        return $this->createMockeryMock($targetClass);
    }
}
