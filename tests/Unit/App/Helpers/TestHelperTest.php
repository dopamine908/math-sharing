<?php

namespace Tests\Unit\App\Helpers;

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
        $mockFoo = $this->createMockeryMock(Foo::class);

        // Assert
        $this->assertInstanceOf(expected: Foo::class, actual: $mockFoo);
        $this->assertSame(expected: $mockFoo, actual: app()->get(Foo::class));
    }
}

class Foo
{
}
