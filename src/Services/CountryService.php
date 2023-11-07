<?php

namespace Crassq\Vin\Services;

class CountryService
{
    private mixed $countries;

    public function __construct()
    {
        $this->countries = include __DIR__ . '/../../data/countries.php';
    }

    /**
     * @param string $wmi
     * @return mixed
     */
    public function getCountryFromWmi(string $wmi): mixed
    {
        return $this->countries[$wmi[0] . $wmi[1]] ?? trans('vin_messages.environment.Unknown');
    }
}
