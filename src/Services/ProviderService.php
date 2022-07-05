<?php

namespace Libaro\ShipmentTracker\Services;

use Libaro\ShipmentTracker\Models\Provider;

class ProviderService
{
    public static function getProviderByBarcodeTag(int $tag): ?Provider
    {
        $providers = self::getProviders();

        $providerObject = null;

        foreach ($providers as $provider) {
            if ($provider['barcode_tag'] === $tag) {
                $providerObject = self::makeProvider($provider);
            }
        }

        return $providerObject;
    }

    public static function makeProvider(array $provider): Provider
    {
        return (new Provider())
            ->name($provider['name'])
            ->label($provider['label'])
            ->adapter($provider['adapter'])
            ->barcodeTag($provider['barcode_tag'])
            ->credentials($provider['credentials']);
    }

    public static function getProviders()
    {
        $providers = config('shipment-tracker.providers');

        return array_filter($providers, function ($provider) {
            return $provider['enabled'];
        });
    }
}
