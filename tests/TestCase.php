<?php

namespace Libaro\ShipmentTracker\Tests;

use Libaro\ShipmentTracker\ShipmentTrackerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ShipmentTrackerServiceProvider::class,
        ];
    }
}
