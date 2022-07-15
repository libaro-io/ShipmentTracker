<?php

namespace Libaro\ShipmentTracker\Adapters;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Libaro\ShipmentTracker\Contracts\ShipmentAdapter;
use Libaro\ShipmentTracker\Exceptions\TrackException;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;
use Psr\Http\Message\ResponseInterface;

class BPostAdapter implements ShipmentAdapter
{
    /**
     * @throws TrackException|GuzzleException
     */
    public function track(Provider $provider, string $barCode): Status
    {
        try {
            $response = $this->makeRequest($provider, $barCode);

            if ($response->getStatusCode() !== 200) {
                throw new TrackException();
            }

            return $this->convertToStatus($response->getBody());
        } catch (Exception $e) {
            throw new TrackException("Could not track $barCode with provider BPost");
        }
    }

    /**
     * @throws GuzzleException
     */
    protected function makeRequest(Provider $provider, string $barCode): ResponseInterface
    {
        $url = "https://api-parcel.bpost.be/services/trackedmail/$barCode/trackingInfo";

        $credentials = $provider->credentials;

        $client = new Client();
        $request = new Request('GET', $url, [
            'Authorization' => 'Basic ' . base64_encode($credentials['username'] . ':' . $credentials['password']),
        ]);

        return $client->send($request);
    }

    protected function convertToStatus($body): Status
    {
        // TODO: Create Status object from data in $body

        return new Status();
    }
}
