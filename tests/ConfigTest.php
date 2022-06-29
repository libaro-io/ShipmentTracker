<?php

it('has an array of providers', function () {
    $providers = config('shipment-tracker.providers');

    expect($providers)->toBeArray();
    expect(count($providers))->toBeGreaterThan(0);
});
