<?php

namespace Libaro\ShipmentTracker\Services;

use Illuminate\Support\Collection;
use Libaro\ShipmentTracker\Exceptions\AdapterNotFoundException;
use Libaro\ShipmentTracker\Exceptions\ProviderNotFoundException;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;

class ShipmentService
{
    /**
     * @param array|string $barcode
     * @param null $providerName
     * @return Status|Collection
     * @throws AdapterNotFoundException
     * @throws ProviderNotFoundException
     */
    public function track(array|string $barcode, $providerName = null): Status|Collection
    {
        // check if $barcode is an array
        if (is_array($barcode)) {
            // loop over all of them and track them
            $statuses = new Collection();

            foreach ($barcode as $item) {
                $provider = $this->getProvider($item, $providerName);

                $statuses->push($this->getAdapter($provider)->track($provider, $item));
            }

            return $statuses;
        }

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

        if (! $provider) {
            throw new ProviderNotFoundException("No provider found for barcode: $barcode");
        }

        return $provider;
    }

    /**
     * @throws AdapterNotFoundException
     */
    private function getAdapter(Provider $provider)
    {
        if (! class_exists($provider->adapter)) {
            throw new AdapterNotFoundException("No adapter found for provider $provider->label ($provider->adapter)");
        }

        return new $provider->adapter();
    }
}
