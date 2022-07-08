<?php

namespace Libaro\ShipmentTracker\Adapters;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Libaro\ShipmentTracker\Contracts\ShipmentAdapter;
use Libaro\ShipmentTracker\Exceptions\TrackException;
use Libaro\ShipmentTracker\Models\Provider;
use Libaro\ShipmentTracker\Models\Status;

class PostNLAdapter implements ShipmentAdapter
{
    private Provider $provider;

    /**
     * @throws TrackException
     */
    public function track(Provider $provider, string $barCode): Status
    {
        $this->provider = $provider;

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
            'apikey' => $credentials['api_key'],
        ]);

        return $client->send($request);
    }

    protected function convertToStatus($body)
    {
        $result = json_decode((string)$body);

        if($result->Warnings) {
            throw new TrackException();
        }

        return (new Status())
            ->provider($this->provider->label)
            ->identifier($result->CurrentStatus->Shipment->Barcode)
            ->service($result->CurrentStatus->Shipment->ProductDescription)
            ->updated($this->convertToDate($result->CurrentStatus->Status->TimeStamp))
            ->status($result->CurrentStatus->Status->StatusDescription)
            ->info($result->CurrentStatus->Status->StatusDescription)
            ->from($this->getFromAddress($result->CurrentStatus->Address))
            ->to($this->getToAddress($result->CurrentStatus->Address));
    }

    protected function getEndpoint(): string
    {
        if (App::isLocal()) {
            return "https://api-sandbox.postnl.nl/shipment/v2/status/barcode/";
        }

        return "https://api.postnl.nl/shipment/v2/status/barcode/";
    }

    protected function convertToDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }

    protected function getFromAddress(array $addresses): string
    {
        return $this->getAddress($addresses[0]);
    }

    protected function getToAddress(array $addresses): string
    {
        return $this->getAddress($addresses[1]);
    }

    protected function getAddress($address): string
    {
        $addressString  = "$address->FirstName $address->LastName, ";
        $addressString .= "$address->Street $address->HouseNumber, ";
        $addressString .= "$address->Zipcode $address->City $address->CountryCode";

        return $addressString;
    }
}
