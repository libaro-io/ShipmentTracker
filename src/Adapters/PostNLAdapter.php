<?php

namespace Libaro\ShipmentTracker\Adapters;

use Libaro\ShipmentTracker\Contracts\ShipmentAdapter;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;

class PostNLAdapter implements ShipmentAdapter
{
    public function track(Provider $provider, string $barCode): Status
    {
        // TODO: Implement track() method.
        return new Status();
    }
}
