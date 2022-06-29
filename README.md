# Shipment Tracker

[![Latest Version on Packagist](https://img.shields.io/packagist/v/libaro/shipmenttracker.svg?style=flat-square)](https://packagist.org/packages/libaro/shipmenttracker)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/libaro-io/ShipmentTracker/run-tests?label=tests)](https://github.com/libaro-io/ShipmentTracker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/libaro-io/ShipmentTracker/Check%20&%20fix%20styling?label=code%20style)](https://github.com/libaro-io/ShipmentTracker/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/libaro/shipmenttracker.svg?style=flat-square)](https://packagist.org/packages/libaro/shipmenttracker)

## Package Description
A package to easily track the status of you parcel. 
With support for multiple providers (BPost, PostNL).
A provider can be added by creating an adapter for the new provider.


## Installation

You can install the package via composer:

```bash
composer require libaro/shipmenttracker
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="shipment-tracker-config"
```

This is the contents of the published config file:

```php
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
```

## Usage
You can use the `Shipment` facade to track your parcel.

```php
Shipment::track('5995390550944994')
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/libaro-io/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Libaro](https://github.com/libaro-io)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
