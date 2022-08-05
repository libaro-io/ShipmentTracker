<?php

namespace Libaro\ShipmentTracker\Contracts;

use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;
use Libaro\ShipmentTracker\Models\TrackingOptions;

interface ShipmentAdapter
{
    public function track(TrackingOptions $trackingOptions): Status;
}
