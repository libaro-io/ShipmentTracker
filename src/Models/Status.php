<?php

namespace Libaro\ShipmentTracker\Models;

/**
 * @property string $provider
 */
class Status
{
    public function provider(string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }
}
