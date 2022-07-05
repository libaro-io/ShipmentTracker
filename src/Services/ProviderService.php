<?php

namespace Libaro\ShipmentTracker\Services;

use Libaro\ShipmentTracker\Models\Provider;

class ProviderService
{
    public static function getProviderByName(string $name): ?Provider
    {
        $providers = self::getProviders();

        $providerObject = null;

        foreach ($providers as $provider) {
            if($provider['name'] === $name) {
                $providerObject = self::makeProvider($provider);
            }
        }

        return $providerObject;
    }

    public static function getProviderByBarcode(string $barcode): ?Provider
    {
        $providers = self::getProviders();

        $providerObject = null;

        foreach ($providers as $provider) {
            foreach ($provider['barcode_tags'] as $tag) {
                if (str_starts_with($barcode, $tag)) {
                    $providerObject = self::makeProvider($provider);
                }
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
            ->barcodeTags($provider['barcode_tags'])
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
