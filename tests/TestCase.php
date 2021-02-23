<?php

namespace Cyaoz94\Sms123\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Cyaoz94\Sms123\Sms123ServiceProvider;

class TestCase extends BaseTestCase
{

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            Sms123ServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
