<?php

namespace Libaro\ShipmentTracker\Facades;

use Illuminate\Support\Facades\Facade;


class Shipment extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'shipment';
    }
}
