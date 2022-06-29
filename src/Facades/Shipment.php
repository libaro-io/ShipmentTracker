<?php

namespace Libaro\ShipmentTracker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static track(string $barCode): Status
 */
class Shipment extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'shipment';
    }
}
