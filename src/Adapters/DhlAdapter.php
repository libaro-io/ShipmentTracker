<?php

namespace Libaro\ShipmentTracker\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Libaro\ShipmentTracker\Contracts\ShipmentAdapter;
use Libaro\ShipmentTracker\Exceptions\TrackException;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;
use Psr\Http\Message\ResponseInterface;

class DhlAdapter implements ShipmentAdapter
{
    private Provider $provider;

    /**
     * @throws TrackException
     */
    public function track(Provider $provider, string $barCode): Status
    {
        $this->provider = $provider;

        try {
            $response = $this->makeRequest($barCode);

            if ($response->getStatusCode() != 200) {
                throw new TrackException();
            }

            return $this->convertToStatus($response->getBody());
        } catch (\Exception $e) {
            throw new TrackException("Could not track $barCode with provider DHL");
        }
    }

    protected function makeRequest(string $barCode): ResponseInterface
    {
        $url = "https://api-eu.dhl.com/track/shipments?trackingNumber=$barCode";

        $credentials = $this->provider->credentials;

        $client = new Client();
        $request = new Request('GET', $url, [
            'DHL-API-Key' => $credentials['api_key'],
        ]);

        return $client->send($request);
    }

    protected function convertToStatus($body): Status
    {
        $result = json_decode((string) $body);
        $shipment = $result->shipments[0];

        return (new Status())
            ->provider($this->provider->label)
            ->identifier($shipment->id)
            ->service($shipment->service)
            ->updated($this->convertToDate($shipment->status->timestamp))
            ->status($shipment->status->status)
            ->info(optional($shipment->status)->description ?? '');
    }

    protected function convertToDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}
