<?php

namespace Libaro\ShipmentTracker\Services;

use Illuminate\Support\Collection;
use Libaro\ShipmentTracker\Models\Provider;

class ProviderService
{
    /**
     * Returns a provider for the given name
     *
     * @param string $name
     * @return Provider|null
     */
    public static function getProviderByName(string $name): ?Provider
    {
        return self::getProviders()->first(function($provider) use ($name) {
            return $provider->name === $name;
        });
    }

    /**
     * Returns a provider for the given barcode
     *
     * @param string $barcode
     * @return Provider|null
     */
    public static function getProviderByBarcode(string $barcode): ?Provider
    {
        return self::getProviders()->first(function($provider) use ($barcode) {
            $confirms = false;
            foreach ($provider->barcodeTags as $tag) {
                if (str_starts_with($barcode, $tag)) {
                    $confirms = true;
                }
            }

            return $confirms;
        });
    }

    /**
     * Converts a provider array to an instance of a Provider class.
     *
     * @param array $provider
     * @return Provider
     */
    public static function makeProvider(array $provider): Provider
    {
        return (new Provider())
            ->name($provider['name'])
            ->label($provider['label'])
            ->adapter($provider['adapter'])
            ->barcodeTags($provider['barcode_tags'])
            ->credentials($provider['credentials']);
    }

    /**
     * Returns a collection of enabled providers.
     * Each provider is an instance of the Provider class.
     * Each instance contains: name, label, adapter class, barcode tags and credentials
     *
     * @return Collection
     */
    public static function getProviders(): Collection
    {
        $providers = config('shipment-tracker.providers');

        $collection = new Collection();

        foreach ($providers as $provider) {
            if($provider['enabled']) {
                $collection->add(self::makeProvider($provider));
            }
        }

        return  $collection;
    }

    /**
     * Returns an array of enabled providers.
     * With only their name, label and barcode tags.
     *
     * @return array
     */
    public static function getPublicProviders(): array
    {
        $providers = config('shipment-tracker.providers');

        $results = [];

        foreach($providers as $provider) {
            if($provider['enabled']) {
                $results[] = [
                    'name' => $provider['name'],
                    'label' => $provider['label'],
                    'barcode_tags' => $provider['barcode_tags']
                ];
            }
        }

        return $results;
    }
}
