<?php
namespace Victorybiz\GeoIPLocationTest;

use PHPUnit_Framework_TestCase;
use Victorybiz\GeoIPLocation\GeoIPLocation;

class GeoIPLocationTest extends PHPUnit_Framework_TestCase 
{
    public function testGetCountryCode()
    {
        $expected_result = 'NG';
        $geoip = new GeoIPLocation;
        $geoip->setIP('169.159.76.74');
        $result = $geoip->getCountryCode(); 
        $this->assertEquals($expected_result, $result);
    }
}