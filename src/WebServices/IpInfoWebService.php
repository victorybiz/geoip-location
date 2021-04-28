<?php
namespace Victorybiz\GeoIPLocation\WebServices;

use ipinfo\ipinfo\IPinfo;

class IpInfoWebService extends WebService
{		
  protected $apiUrl = 'https://ipinfo.io?token={TOKEN}';

	protected $token = null;
    
    /**
     * Class Constructor
     * 
     * @return void
     */
    public function __construct($ip, $config)
    {
        parent::__construct($ip);
				$this->config = $config;
    }     

    public function locate() 
    {
		try {
			$client = new IPinfo($this->config['token'], [
				'timeout' => $this->connectTimeout,
			]);
			$details = $client->getDetails($this->ip);
			if ($details) {
				$geo_data = [
					'ip' => $this->ip,
					'city' => (isset($detail->city)) ? $detail->city : null,
					'region' => (isset($detail->region)) ? $detail->region : null,
					'regionCode' => (isset($detail->region)) ? $detail->region : null,
					'country' => (isset($details->country_name)) ? $details->country_name : null,
					'countryCode' => (isset($details->country)) ? $details->country : null,
					'continent' => null,
					'continentCode' => null,
					'latitude' => (isset($details->latitude)) ? $details->latitude : null,
					'longitude' => (isset($details->longitude)) ? $details->longitude : null,
					'timezone' => (isset($details->country)) ? $details->country : null,
					'postalCode' => (isset($details->postal)) ? $details->postal : null,
					'currencyCode' => null,
					'currencySymbol' => null,
					'currencyExchangeRate' => null,
				];
			} else {
				$geo_data = $this->getDefault();
			} 
		} catch(\Exception $e){
			$geo_data = $this->getDefault();
		}
        return $geo_data;    
    }   
    
}
