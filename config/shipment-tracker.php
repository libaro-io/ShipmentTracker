<?php

return [
    'providers' => [
        [
            'name' => 'bpost',
            'label' => 'BPost',
            'adapter' => \Libaro\ShipmentTracker\Adapters\BPostAdapter::class,
            'barcode_tag' => 3232,
            'credentials' => [
                'username' => env('SHIPMENT_TRACKER_BPOST_USERNAME'),
                'password' => env('SHIPMENT_TRACKER_BPOST_PASSWORD'),
            ],
        ],
        [
            'name' => 'post_nl',
            'label' => 'PostNL',
            'adapter' => \Libaro\ShipmentTracker\Adapters\PostNLAdapter::class,
            'barcode_tag' => 0,
            'credentials' => [
            ],
        ],
    ],
];
