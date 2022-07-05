<?php

namespace Libaro\ShipmentTracker\Tests;

use Illuminate\Support\Facades\Config;

final class ConfigTest extends TestCase
{
    public function test_is_has_an_array_of_providers()
    {
        $providers = Config::get('shipment-tracker.providers');

        $this->assertIsArray($providers);
        $this->assertGreaterThan(0, count($providers));
    }
}
