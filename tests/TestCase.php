<?php

namespace Tests;

use BangLipai\Utility\Test\LazilyRefreshDatabase;
use BangLipai\Utility\Test\LogRequest;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;
    use LogRequest;
}
