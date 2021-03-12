<?php
namespace Victorybiz\GeoIPLocation\WebServices;

use GuzzleHttp\Client;

class WebService
{
    protected $guzzleClient;

    protected $connectTimeout = 5;

    protected $ip = null;

	protected $currency = null;

    public function __construct($ip, $currency = null)
    {
        $this->ip = $ip;
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