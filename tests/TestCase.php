<?php

namespace Libaro\ShipmentTracker\Tests;

use Libaro\ShipmentTracker\ShipmentTrackerServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
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
