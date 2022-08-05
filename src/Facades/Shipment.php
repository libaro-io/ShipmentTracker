<?php

namespace Libaro\ShipmentTracker\Facades;

use Illuminate\Support\Facades\Facade;
use Libaro\ShipmentTracker\Builders\TrackingBuilder;

/**
 * @method static TrackingBuilder trackingCode(string $barcode, ?string $providerName)
 */
class Shipment extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'shipment';
    }
}
