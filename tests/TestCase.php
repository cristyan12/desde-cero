<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function create($class, $attributes = [])
    {
        return factory($class)->create($attributes);
    }
}
