<?php

namespace Tests\Unit\Helpers;

use App\Helpers\TestHelper;
use Tests\TestCase;

class TestHelperTest extends TestCase
{
    /**
     * @test
     */
    public function testCreateMock()
    {
        // Actual
        $mockFoo = TestHelper::createMock(Foo::class);

        // Assert
        $this->assertInstanceOf(expected: Foo::class, actual: $mockFoo);
        $this->assertSame(expected: $mockFoo, actual: app()->get(Foo::class));
    }
}

class Foo
{
}
