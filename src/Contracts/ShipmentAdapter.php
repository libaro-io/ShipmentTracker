<?php

namespace Libaro\ShipmentTracker\Contracts;

use Libaro\ShipmentTracker\Models\Status;
use Libaro\ShipmentTracker\Models\Provider;

interface ShipmentAdapter
{
    public function track(Provider $provider, string $barCode): Status;
}
