<?php

namespace Libaro\ShipmentTracker\Models;

class TrackingOptions
{
    private ?string $zipCode = null;
    private string $trackingCode;

    public function __construct(string $trackingCode)
    {
        $this->trackingCode = $trackingCode;
    }

    public function setZipCode(?string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function getTrackingCode(): string
    {
        return $this->trackingCode;
    }
}
