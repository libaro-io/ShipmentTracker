<?php

namespace Libaro\ShipmentTracker\Services;

use Libaro\ShipmentTracker\Models\Status;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Exceptions\AdapterNotFoundException;
use Libaro\ShipmentTracker\Exceptions\ProviderNotFoundException;


class ShipmentService
{
    /**
     * @throws ProviderNotFoundException
     * @throws AdapterNotFoundException
     * @param string $barcode
     */
    public function track(string $barcode): Status
    {
        $provider = $this->getProvider($barcode);
        $adapter = $this->getAdapter($provider);

        return $adapter->track($provider, $barcode);
    }

    /**
     * @throws ProviderNotFoundException
     */
    private function getProvider(string $barcode): Provider
    {
        $tag = substr($barcode, 0, 4);

        $provider = ProviderService::getProviderByBarcodeTag($tag);

        if(!$provider) {
            throw new ProviderNotFoundException("No provider found for barcode beginning with $tag");
        }

        return $provider;
    }

    /**
     * @throws AdapterNotFoundException
     */
    private function getAdapter(Provider $provider)
    {
        if(!class_exists($provider->adapter)) {
            throw new AdapterNotFoundException("No adapter found for provider $provider->label ($provider->adapter)");
        }

        return new $provider->adapter;
    }
}
