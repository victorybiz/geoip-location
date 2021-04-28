<?php
namespace Victorybiz\GeoIPLocation;

use Victorybiz\GeoIPLocation\WebServices\GeoPluginWebService;
use Victorybiz\GeoIPLocation\WebServices\IpInfoWebService;

class GeoIPLocation
{   
    protected $config = null;

    protected $ipLocated = false;

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

    protected $invalidIps = [
        '::1', '127.0.0.1', '192.168.65.0'
    ];

    protected $localhostIp = '169.159.82.111';

    protected $baseCurrency = 'USD';
   
    public function __construct($config = [])
    {

        if (isset($config['ip'])) {
            $this->ip = $config['ip'];
        }
        
        if (isset($config['baseCurrency'])) {
            $this->baseCurrency =  $config['baseCurrency'];
        } else {
            $config['baseCurrency'] = $this->baseCurrency;
        }

        $this->config = $config;
    }

    protected function locate() 
    {
        $default_web_service = 'geoplugin';

        switch ($default_web_service) {
            case 'ipinfo':
                $token =  null;
                $webService = new IpInfoWebService($this->getIP(), $this->config);
                $this->geoData =  $webService->locate();
                break;    
            case 'geoplugin':
                $webService = new GeoPluginWebService($this->getIP(), $this->config);
                $this->geoData =  $webService->locate();
                break;         
            default:
                $webService = new GeoPluginWebService($this->getIP(), $this->config);
                $this->geoData =  $webService->locate();
                break;
        }       
        $this->ipLocated = true;
    }

    public function setIP($ip)
    {
        if (! filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
            $this->ip = $ip;
            $this->ipLocated = false;
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
    
            if (in_array($ip, $this->invalidIps)) {
                $ip = $this->localhostIp; 
            }
            $this->ip = trim($ip);
            return $ip;
        }
	}    

    public function getCity()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['city'];
    }

    public function getRegion()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['region'];
    }

    public function getRegionCode()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['regionCode'];
    }

    public function getCountry()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['country'];
    }

    public function getCountryCode()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['countryCode'];
    }

    public function getContinent()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['continent'];
    }

    public function getContinentCode()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['continentCode'];
    }

    public function getPostalCode()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['postalCode'];
    }

    public function getLatitude()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['latitude'];
    }

    public function getLongitude()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['longitude'];
    }

    public function getCurrencyCode()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['currencyCode'];
    }

    public function getCurrencySymbol()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['currencySymbol'];
    }

    public function getCurrencyExchangeRate()
    {
        if (!$this->ipLocated) {
            $this->locate();
        }
        return $this->geoData['currencyExchangeRate'];
    }
    
    public function getLocation()
    {   
        if (!$this->ipLocated) {
            $this->locate();
        }
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
