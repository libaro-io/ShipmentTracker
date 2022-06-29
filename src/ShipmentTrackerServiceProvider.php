<?php

namespace Libaro\ShipmentTracker;

use Illuminate\Support\ServiceProvider;
use Libaro\ShipmentTracker\Services\ShipmentService;

class ShipmentTrackerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/shipment-tracker.php', 'shipment-tracker');
    }

    public function register()
    {
        $this->app->bind('shipment', function ($app) {
            return new ShipmentService();
        });
    }
}
