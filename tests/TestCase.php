<?php

namespace Tests;

use Codeception\Specify;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Specify;
}
