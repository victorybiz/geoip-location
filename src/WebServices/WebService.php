<?php
namespace Victorybiz\GeoIPLocation\WebServices;

use GuzzleHttp\Client;

class WebService
{
    protected $guzzleClient;

    protected $connectTimeout = 5;

    protected $config = null;

    protected $ip = null;

    public function __construct($ip, $config)
    {
        $this->ip = $ip;
        $this->config = $config;
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
            'ip' => $this->ip,
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