## Simple VIN decoder for PHP 7.1+ based on ISO-3779

[![Gitter](https://badges.gitter.im/crassq/support.png)](https://gitter.im/crassq/support)
[![Build Status](https://circleci.com/gh/crassq/vin.svg?style=shield)](https://circleci.com/gh/crassq/vin)
[![Code Coverage](https://scrutinizer-ci.com/g/crassq/vin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/crassq/vin/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/crassq/vin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/crassq/vin/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/crassq/vin.svg?label=downloads)](https://packagist.org/packages/crassq/vin)
[![Latest Stable Version](https://img.shields.io/packagist/v/crassq/vin.svg?label=version)](https://packagist.org/packages/crassq/vin)
[![License](https://img.shields.io/packagist/l/crassq/vin.svg?label=license)](https://packagist.org/packages/crassq/vin)

## Installation

```bash
composer require crassq/vin
```

## How to use?

```php
use InvalidArgumentException;
use CRASSQ\Vin\Vin;

try {
    $vin = new Vin('WVWZZZ1KZ6W612305');
} catch (InvalidArgumentException $e) {
    // It isn't a valid VIN...
}

$vin->getVin(); // "WVWZZZ1KZ6W612305"
$vin->getWmi(); // "WVW"
$vin->getVds(); // "ZZZ1KZ"
$vin->getVis(); // "6W612305"
$vin->getRegion(); // "Europe"
$vin->getCountry(); // "Germany"
$vin->getManufacturer(); // "Volkswagen"
$vin->getModelYear(); // [2006]

// convert the VIN to a string
(string) $vin;

// converts the VIN to array
$vin->toArray();
```

## Useful links

* https://en.wikipedia.org/wiki/Vehicle_identification_number
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)
* https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/Model_year
