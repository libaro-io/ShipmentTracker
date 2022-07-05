<?php

namespace Libaro\ShipmentTracker\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\App;
use Libaro\ShipmentTracker\Contracts\ShipmentAdapter;
use Libaro\ShipmentTracker\Exceptions\TrackException;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;

class PostNLAdapter implements ShipmentAdapter
{
    /**
     * @throws TrackException
     */
    public function track(Provider $provider, string $barCode): Status
    {
        try {
            $response = $this->makeRequest($provider, $barCode);

            if ($response->getStatusCode() != 200) {
                throw new TrackException();
            }

            return $this->convertToStatus($response->getBody());
        } catch (\Exception $e) {
            throw new TrackException("Could not track $barCode with provider PostNL");
        }
    }

    protected function makeRequest(Provider $provider, string $barCode)
    {
        $url = $this->getEndpoint() . $barCode;

        $credentials = $provider->credentials;

        $client = new Client();
        $request = new Request('GET', $url, [
            'accept' => 'application/json',
            'apiKey' => $credentials['api_key'],
        ]);

        return $client->send($request);
    }

    protected function convertToStatus($body)
    {
        $result = json_decode((string)$body);

        // TODO: Create Status object from data in $body

        return new Status();
    }

    protected function getEndpoint(): string
    {
        if (App::isLocal()) {
            return "https://api-sandbox.postnl.nl/shipment/v2/status/barcode/";
        }

        return "https://api.postnl.nl/shipment/v2/status/barcode/";
    }
}
