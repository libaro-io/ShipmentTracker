<?php

namespace Libaro\ShipmentTracker\Services;

use Libaro\ShipmentTracker\Exceptions\AdapterNotFoundException;
use Libaro\ShipmentTracker\Exceptions\ProviderNotFoundException;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;

class ShipmentService
{
    /**
     * @param string $barcode
     * @param null $providerName
     * @return Status
     * @throws AdapterNotFoundException
     * @throws ProviderNotFoundException
     */
    public function track(string $barcode, $providerName = null): Status
    {
        $provider = $this->getProvider($barcode, $providerName);

        return $this->getAdapter($provider)->track($provider, $barcode);
    }

    /**
     * @throws ProviderNotFoundException
     */
    private function getProvider(string $barcode, $providerName): Provider
    {
        if ($providerName) {
            $provider = ProviderService::getProviderByName($providerName);
        } else {
            $provider = ProviderService::getProviderByBarcode($barcode);
        }

        if (!$provider) {
            throw new ProviderNotFoundException("No provider found for barcode: $barcode");
        }

        return $provider;
    }

    /**
     * @throws AdapterNotFoundException
     */
    private function getAdapter(Provider $provider)
    {
        if (!class_exists($provider->adapter)) {
            throw new AdapterNotFoundException("No adapter found for provider $provider->label ($provider->adapter)");
        }

        return new $provider->adapter();
    }
}
