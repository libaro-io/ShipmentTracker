<?php

namespace Libaro\ShipmentTracker\Tests;

use Libaro\ShipmentTracker\Models\Status;

final class StatusTest extends TestCase
{
    public function test_it_can_be_created()
    {
        $status = new Status();

        $this->assertInstanceOf(Status::class, $status);
    }

    public function test_it_can_have_a_provider()
    {
        $status = new Status();
        $status->provider(\Libaro\ShipmentTracker\Adapters\BPostAdapter::class);

        $this->assertEquals(\Libaro\ShipmentTracker\Adapters\BPostAdapter::class, $status->provider);
    }
}
