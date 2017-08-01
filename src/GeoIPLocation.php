<?php

namespace Victorybiz\GeoIPLocation;

use Victorybiz\GeoIPLocation\WebServices\GeoPluginWebService;

class GeoIPLocation
{   
    protected $ip = null;
    protected $geoData = [
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
   
    public function __construct()
    {
        $this->locate();
    }

    protected function locate() 
    {
        $ip = $this->getIP();
        $web_service = new GeoPluginWebService();
        $this->geoData =  $web_service->locate($ip);
    }

    public function setIP($ip)
    {
        if (! filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
            $this->ip = $ip;
            $this->locate();
        } else {
            //throw new Exception("Invalid IP");
        }
    }
      
	public function getIP() 
    {
        if (! empty($this->ip)) {
            return $this->ip;
        } else {
            global $_SERVER;
            $set_localhost_ip_as = '169.159.82.111';

            $ip = @$_SERVER["REMOTE_ADDR"];

            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }           
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }            
            // Detect IP when using Cloudflare to accelerate your site
            if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
            }           
    
            if ($ip == "::1" || $ip == "127.0.0.1") {
                $ip = $set_localhost_ip_as; 
            }
            $ip = trim($ip);
            $this->ip = $ip;
            return $ip;
        }
	}    

    public function getCity()
    {
        if (empty($this->geoData['city'])) {
            $this->locate();
        }
        return $this->this->geoData['city'];
    }

    public function getRegion()
    {
        if (empty($this->geoData['region'])) {
            $this->locate();
        }
        return $this->geoData['region'];
    }

    public function getRegionCode()
    {
        if (empty($this->geoData['regionCode'])) {
            $this->locate();
        }
        return $this->geoData['regionCode'];
    }

    public function getCountry()
    {
        if (empty($this->geoData['country'])) {
            $this->locate();
        }
        return $this->geoData['country'];
    }

    public function getCountryCode()
    {
        if (empty($this->geoData['countryCode'])) {
            $this->locate();
        }
        return $this->geoData['countryCode'];
    }

    public function getContinent()
    {
        if (empty($this->geoData['continent'])) {
            $this->locate();
        }
        return $this->geoData['continent'];
    }

    public function getContinentCode()
    {
        if (empty($this->geoData['continentCode'])) {
            $this->locate();
        }
        return $this->geoData['continentCode'];
    }

    public function getPostalCode()
    {
        if (empty($this->geoData['postalCode'])) {
            $this->locate();
        }
        return $this->geoData['postalCode'];
    }

    public function getLatitude()
    {
        if (empty($this->geoData['latitude'])) {
            $this->locate();
        }
        return $this->geoData['latitude'];
    }

    public function getLongitude()
    {
        if (empty($this->geoData['longitude'])) {
            $this->locate();
        }
        return $this->geoData['longitude'];
    }

    public function getCurrencyCode()
    {
        if (empty($this->geoData['currencyCode'])) {
            $this->locate();
        }
        return $this->geoData['currencyCode'];
    }

    public function getCurrencySymbol()
    {
        if (empty($this->geoData['currencySymbol'])) {
            $this->locate();
        }
        return $this->geoData['currencySymbol'];
    }

    public function getCurrencyExchangeRate()
    {
        if (empty($this->geoData['currencyExchangeRate'])) {
            $this->locate();
        }
        return $this->geoData['currencyExchangeRate'];
    }
    
    public function getLocation()
    {   
        $this->locate();
        //Location string
        $location       = '';
        $city           = $this->geoData['city'];
        $location       = (!empty($city))? "$location $city," : $location;
        $region         = $this->geoData['region'];
        $location       = (!empty($region))? "$location $region," : $location;
        $country        = $this->geoData['country'];
        $location       = (!empty($country))? "$location $country" : $location;
        return $location;
    }
}
