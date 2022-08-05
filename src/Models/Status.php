<?php

namespace Libaro\ShipmentTracker\Models;

use Illuminate\Support\Carbon;

/**
 * @property string $provider
 * @property string $info
 * @property string $identifier
 * @property string $service
 * @property Carbon $updated
 * @property string $status
 * @property string $receiver
 * @property string $from
 * @property string $to
 */
class Status
{
    /**
     * The label of the provider which was used to track the parcel.
     *
     * @param string $provider
     * @return $this
     */
    public function provider(string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * The code or barcode which was used to track the parcel.
     * This comes from the response of the provider.
     *
     * @param string $identifier
     * @return $this
     */
    public function identifier(string $identifier): Status
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Which service of the provider is used for sending the package.
     * This is provider specific.
     *
     * @param string $service
     * @return $this
     */
    public function service(string $service): Status
    {
        $this->service = $service;

        return $this;
    }

    /**
     * When the tracking info at the providers side was last updated.
     *
     * @param Carbon $updated
     * @return $this
     */
    public function updated(Carbon $updated): Status
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * What is the status of the parcel.
     * Examples: transit, delivered, ...
     *
     * @param string $status
     * @return $this
     */
    public function status(string $status): Status
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Who is the receiver of the parcel.
     * Examples: full name of the person or company
     *
     * @param string $receiver
     * @return $this
     */
    public function receiver(string $receiver): Status
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * A more descriptive sentence of the status of your parcel.
     * Could be provided by the provider, if not should be provided
     * By your adapter.
     *
     * @param string $info
     * @return $this
     */
    public function info(string $info): Status
    {
        $this->info = $info;

        return $this;
    }

    /**
     * A string representing the from address
     *
     * @param string $from
     * @return $this
     */
    public function from(string $from): Status
    {
        $this->from = $from;

        return $this;
    }

    /**
     * A string representing the to address
     *
     * @param string $to
     * @return $this
     */
    public function to(string $to): Status
    {
        $this->to = $to;

        return $this;
    }
}
