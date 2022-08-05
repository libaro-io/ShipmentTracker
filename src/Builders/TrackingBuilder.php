<?php

namespace Libaro\ShipmentTracker\Builders;

use Libaro\ShipmentTracker\Contracts\ShipmentAdapter;
use Libaro\ShipmentTracker\Models\Status;
use Libaro\ShipmentTracker\Models\TrackingOptions;

class TrackingBuilder
{
    private TrackingOptions $trackingOptions;
    private ShipmentAdapter $shipmentAdapter;

    public function __construct(ShipmentAdapter $shipmentAdapter, string $barCode)
    {
        $this->shipmentAdapter = $shipmentAdapter;
        $this->trackingOptions = new TrackingOptions($barCode);
    }

    public function zipcode(?string $zipCode): static
    {
        $this->trackingOptions->setZipCode($zipCode);

        return $this;
    }

    public function track(): Status
    {
        return $this->shipmentAdapter->track($this->trackingOptions);
    }
}
