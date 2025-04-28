<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Dusk\TestCase as BaseDuskTestCase;

abstract class DuskTestCase extends BaseDuskTestCase
{
    use CreatesApplication;
}
