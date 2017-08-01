<?php

namespace Victorybiz\GeoIPLocation\WebServices;

use GuzzleHttp\Client;

class WebService
{


    protected $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new Client();
    }


    /**
     * Get the default values
     *
     * @return array
     */
    protected function getDefault()
    {
        return [
            'ip' => null,
            'city' => null,
            'region' => null,
            'regionCode' => null,
            'country' => null,
            'countryCode' => null,
            'continent' => null,
            'continentCode' => null,
            'postalCode' => null,
            'latitude' => null,
            'longitude' => null,
            'timezone' => null,
            'currencyCode' => null,
            'currencySymbol' => null,
            'currencyExchangeRate' => null,
        ];
    }
}