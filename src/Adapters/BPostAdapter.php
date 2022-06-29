<?php

namespace Libaro\ShipmentTracker\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Libaro\ShipmentTracker\Models\Status;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Contracts\ShipmentAdapter;
use Libaro\ShipmentTracker\Exceptions\TrackException;

class BPostAdapter implements ShipmentAdapter
{
    /**
     * @throws TrackException
     */
    public function track(Provider $provider, string $barCode): Status
    {
        try {
            $response = $this->makeRequest($provider, $barCode);

            if($response->getStatusCode() != 200) {
                throw new TrackException();
            }

            return $this->convertToStatus($response->getBody());

        } catch (\Exception $e) {
            throw new TrackException("Could not track $barCode with provider BPost");
        }
    }

    protected function makeRequest(Provider $provider, string $barCode)
    {
        $url = "https://api-parcel.bpost.be/services/trackedmail/$barCode/trackingInfo";

        $credentials = $provider->credentials;

        $client = new Client();
        $request = new Request('GET', $url, [
            'Authorization' => 'Basic ' . base64_encode($credentials['username'] . ':' . $credentials['password'])
        ]);

        return $client->send($request);
    }

    protected function convertToStatus($body)
    {
        // TODO: Create Status object from data in $body

        return new Status();
    }
}
