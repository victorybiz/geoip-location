# GeoIP Location
Get the geographical location of website visitors based on their IP addresses.

## Installation
Install using composer, from the command line run:

```bash
$ composer require victorybiz/geoip-location
```

### Laravel Project

Once installed you need to register the service provider with the application. Open up `config/app.php` and locate the `providers` key.

```php
'providers' => [

    Victorybiz\GeoIPLocation\GeoIPLocationServiceProvider::class,

]
```

### PHP (Non-Laravel) Project

Require the autoload in your php script.

```php
    require_once 'path/to/vendor/autoload.php';
```
## Usage 

```php
    $geoip = new GeoIPLocation;

    $geoip->getIP(); // Return client IP

    $geoip->setIP('0.0.0.0'); // Set an IP to get its geographical location

    $geoip->getCity(); // Return client IP City (null if none)

    $geoip->getRegion(); // Return client IP Region (null if none)

    $geoip->getRegionCode(); // Return client IP Region Code (null if none)

    $geoip->getCountry(); // Return client IP Country

    $geoip->getCountryCode(); // Return client IP Country Code

    $geoip->getContinent(); // Return client IP Continent 

    $geoip->getContinentCode(); // Return client IP Continent Code

    $geoip->getPostalCode(); // Return client IP Postal Code (null if none)

    $geoip->getLatitude(); // Return client IP Latitude (null if none)

    $geoip->getLongitude(); // Return client IP Longitude (null if none)

    $geoip->getCurrencyCode(); // Return client IP Country Currency Code (null if none)

    $geoip->getCurrencySymbol(); // Return client IP Country Currency Symbol (null if none)

    $geoip->getCurrencyExchangeRate(); // Return client IP Country Currency Exchange Rate against NGN (null if none)

    $geoip->getLocation(); // Return client IP Location string (city, region, country)
```

## Web Services
### geoPlugin
GeoIP Location uses a geolocation web service from [geoPlugin](http://www.geoplugin.com/) 

##Bug Reports and Issue tracking 

Kindly make use of the issue tracker for bug reports, feature request, additional web service request and security issues. 

##License
[MIT](http://opensource.org/licenses/MIT) 
