<?php

namespace Libaro\ShipmentTracker\Contracts;

use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;

interface ShipmentAdapter
{
    public function track(Provider $provider, string $barCode): Status;
}
