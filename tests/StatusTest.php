<?php

use Libaro\ShipmentTracker\Models\Status;

it('can be created', function () {
    $status = new Status();

    expect($status)->toBeInstanceOf(Status::class);
});

it('can have a provider', function () {
    $status = new Status();
    $status->provider(\Libaro\ShipmentTracker\Adapters\BPostAdapter::class);

    expect($status->provider)->toEqual(\Libaro\ShipmentTracker\Adapters\BPostAdapter::class);
});
