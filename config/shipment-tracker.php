<?php

return [
    'providers' => [
        [
            'enabled' => true,
            'name' => 'bpost',
            'label' => 'BPost',
            'adapter' => \Libaro\ShipmentTracker\Adapters\BPostAdapter::class,
            'barcode_tags' => [3232],
            'credentials' => [
                'username' => env('SHIPMENT_TRACKER_BPOST_USERNAME'),
                'password' => env('SHIPMENT_TRACKER_BPOST_PASSWORD'),
            ],
        ],
        [
            'enabled' => true,
            'name' => 'post_nl',
            'label' => 'PostNL',
            'adapter' => \Libaro\ShipmentTracker\Adapters\PostNLAdapter::class,
            'barcode_tags' => ['3S', 'CD'],
            'credentials' => [
                'api_key' => env('SHIPMENT_TRACKER_POSTNL_API_KEY')
            ],
        ],
        [
            'enabled' => true,
            'name' => 'dhl',
            'label' => 'DHL',
            'adapter' => \Libaro\ShipmentTracker\Adapters\DhlAdapter::class,
            'barcode_tags' => [],
            'credentials' => [
                'api_key' => env('SHIPMENT_TRACKER_DHL_API_KEY'),
                'api_secret' => env('SHIPMENT_TRACKER_DHL_API_SECRET')
            ],
        ],
    ],
];
