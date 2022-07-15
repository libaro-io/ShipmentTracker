<?php

namespace Libaro\ShipmentTracker;

use Illuminate\Support\ServiceProvider;
use Libaro\ShipmentTracker\Services\ShipmentService;

class ShipmentTrackerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/shipment-tracker.php' => config_path('shipment-tracker.php'),
        ], 'shipment-tracker-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/shipment-tracker.php', 'shipment-tracker-config');
        $this->app->bind('shipment', function ($app) {
            return new ShipmentService();
        });
    }
}
