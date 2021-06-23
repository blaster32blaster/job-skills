<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp() :void
    {
        parent::setUp();
        $this->buildDatabase();
    }

    protected function buildDatabase()
    {
        $this->artisan('csv-parse:job-posting-csv');
    }
}

