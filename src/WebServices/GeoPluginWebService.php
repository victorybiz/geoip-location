<?php
namespace Victorybiz\GeoIPLocation\WebServices;

class GeoPluginWebService extends WebService
{		
	protected $apiUrl = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}';
    
    /**
     * Class Constructor
     * 
     * @return void
     */
    public function __construct($ip, $config)
    {
        parent::__construct($ip, $config);
    }    

    public function locate() 
    {
        $ip_api_url = $this->apiUrl;
        $ip_api_url = str_replace( '{IP}', $this->ip, $ip_api_url );
				$ip_api_url = str_replace( '{CURRENCY}', $this->config['baseCurrency'], $ip_api_url );
		
		try {
			$client = $this->guzzleClient; // Guzzle HTTP Client
			$response = $client->request('GET', $ip_api_url, [
				'connect_timeout' => $this->connectTimeout,
				'timeout' => $this->connectTimeout,
				'headers' => [
					'Accept'     => 'application/json',
					'Content-Type'     => 'application/json',
				]
			]);
			$status_code = $response->getStatusCode();
			if ($status_code == 200) {
				$response_content = $response->getBody()->getContents();
				$data = @unserialize($response_content);
				
				$continents = [
					"AF" => "Africa",
					"AN" => "Antarctica",
					"AS" => "Asia",
					"EU" => "Europe",
					"OC" => "Australia (Oceania)",
					"NA" => "North America",
					"SA" => "South America"
				];

				if (isset($data['geoplugin_continentCode']) && !empty($data['geoplugin_continentCode'])) {
					$continent_name = (isset($continents[strtoupper($data['geoplugin_continentCode'])])) ? $continents[strtoupper($data['geoplugin_continentCode'])] : null;
				} else {
					$continent_name = null;
				}
			   
				$geo_data = [
					'ip' => $this->ip,
					'city' => (isset($data['geoplugin_city'])) ? $data['geoplugin_city'] : null,
					'region' => (isset($data['geoplugin_region'])) ? $data['geoplugin_region'] : null,
					'regionCode' => (isset($data['geoplugin_region'])) ? $data['geoplugin_region'] : null,
					'country' => (isset($data['geoplugin_countryName'])) ? $data['geoplugin_countryName'] : null,
					'countryCode' => (isset($data['geoplugin_countryCode'])) ? $data['geoplugin_countryCode'] : null,
					'continent' => $continent_name,
					'continentCode' => (isset($data['geoplugin_continentCode'])) ? $data['geoplugin_continentCode'] : null,
					'latitude' => (isset($data['geoplugin_latitude'])) ? $data['geoplugin_latitude'] : null,
					'longitude' => (isset($data['geoplugin_longitude'])) ? $data['geoplugin_longitude'] : null,
					'timezone' => (isset($data['geoplugin_countryCode'])) ? $data['geoplugin_countryCode'] : null,
					'postalCode' => (isset($data['geoplugin_countryCode'])) ? $data['geoplugin_countryCode'] : null,
					'currencyCode' => (isset($data['geoplugin_currencyCode'])) ? $data['geoplugin_currencyCode'] : null,
					'currencySymbol' => (isset($data['geoplugin_currencySymbol'])) ? $data['geoplugin_currencySymbol'] : null,
					'currencyExchangeRate' => (isset($data['geoplugin_currencyConverter'])) ? $data['geoplugin_currencyConverter'] : null,
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
