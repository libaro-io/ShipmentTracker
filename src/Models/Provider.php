<?php

namespace Libaro\ShipmentTracker\Models;

class Provider
{
    public string $name;
    public string $label;
    public string $adapter;
    public array $barcodeTags;
    public array $credentials;

    public function name(string $name): Provider
    {
        $this->name = $name;

        return $this;
    }

    public function label(string $label): Provider
    {
        $this->label = $label;

        return $this;
    }

    public function adapter(string $adapter): Provider
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function barcodeTags(array $barcodeTags): Provider
    {
        $this->barcodeTags = $barcodeTags;

        return $this;
    }

    public function credentials(array $credentials): Provider
    {
        $this->credentials = $credentials;

        return $this;
    }
}
