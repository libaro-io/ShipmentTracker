# :package_description

[![Latest Version on Packagist](https://img.shields.io/packagist/v/libaro/shipmenttracker.svg?style=flat-square)](https://packagist.org/packages/libaro/shipmenttracker)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/libaro-io/ShipmentTracker/run-tests?label=tests)](https://github.com/libaro-io/ShipmentTracker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/libaro-io/ShipmentTracker/Check%20&%20fix%20styling?label=code%20style)](https://github.com/libaro-io/ShipmentTracker/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/libaro/shipmenttracker.svg?style=flat-square)](https://packagist.org/packages/libaro/shipmenttracker)

# Package Description
// TODO: Add Package Description


## Installation

You can install the package via composer:

```bash
composer require libaro/shipmenttracker
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="shipment-tracker-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="shipment-tracker-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage
TODO: Add Usage Documentation

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
