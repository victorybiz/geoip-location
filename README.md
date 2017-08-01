# GeoIP Location
Get the geographical location of website visitors based on their IP addresses.

## Installation
Install using composer, from the command line run:

```bash
$ composer require victorybiz/geoip-location
```
### Laravel Project
Alternatively, you can add `"victorybiz/geoip-location": "^0.1.0"` to your composer.json file's `require` section and 
then run `$ composer update`.

Once installed you need to register the service provider with the application. Open up `config/app.php` and locate the `providers` key.

```php
'providers' => [

    Victorybiz\GeoIPLocation\GeoIPLocationServiceProvider::class,

]
```


{
    "require": {
        "victorybiz/geoip-location": "^0.1.0"
    }
}
### PHP (Non-Laravel) Project
Require the autoload file in your php script.

```php
    require_once 'path/to/vendor/autoload.php';
```
## Usage 

```php
    $geoip = new GeoIPLocation;

    echo $geoip->getIP(); // Return client IP

    echo $geoip->setIP('0.0.0.0'); // Set an IP to get its geographical location

    echo $geoip->getCity(); // Return client IP City (null if none)

    echo $geoip->getRegion(); // Return client IP Region (null if none)

    echo $geoip->getRegionCode(); // Return client IP Region Code (null if none)

    echo $geoip->getCountry(); // Return client IP Country

    echo $geoip->getCountryCode(); // Return client IP Country Code

    echo $geoip->getContinent(); // Return client IP Continent 

    echo $geoip->getContinentCode(); // Return client IP Continent Code

    echo $geoip->getPostalCode(); // Return client IP Postal Code (null if none)

    echo $geoip->getLatitude(); // Return client IP Latitude (null if none)

    echo $geoip->getLongitude(); // Return client IP Longitude (null if none)

    echo $geoip->getCurrencyCode(); // Return client IP Country Currency Code (null if none)

    echo $geoip->getCurrencySymbol(); // Return client IP Country Currency Symbol (null if none)

    echo $geoip->getCurrencyExchangeRate(); // Return client IP Country Currency Exchange Rate against NGN (null if none)

    echo $geoip->getLocation(); // Return client IP Location string (city, region, country)
```

## Web Services
### geoPlugin
GeoIP Location uses a geolocation web service from [geoPlugin](http://www.geoplugin.com/) 

## Bug Reports and Issue tracking 

Kindly make use of the issue tracker for bug reports, feature request, additional web service request and security issues. 

## License
[MIT](http://opensource.org/licenses/MIT) 
