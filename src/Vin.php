<?php

namespace CRASSQ\Vin;

/** Import classes **/
use Carbon\Carbon;
use InvalidArgumentException;

/** Import functions **/
use function preg_match;
use function sprintf;
use function strpbrk;
use function strtoupper;

/**
 * Vehicle Identification Number
 */
class Vin implements VinInterface
{
    /**
     * Regular expression for a VIN parsing/validation (ISO 3779)
     *
     * @var string
     *
     * @link https://www.iso.org/standard/52200.html
     */
    public const REGEX = '/^(?<wmi>[0-9A-HJ-NPR-Z]{3})(?<vds>[0-9A-HJ-NPR-Z]{6})(?<vis>[0-9A-HJ-NPR-Z]{8})$/';

    /** The VIN value **/
    private string $vin;

    /** World manufacturer identifier **/
    private string $wmi;

    /** Vehicle descriptor section **/
    private string $vds;

    /** Vehicle identifier section **/
    private string $vis;

    /** Vehicle region **/
    private ?string $region;

    /** Vehicle country **/
    private ?string $country;

    /** Vehicle manufacturer **/
    private ?string $manufacturer;

    /** Vehicle model year **/
    private int|array $modelYear;

    /**
     * Constructor of the class
     *
     * @param string $value
     *
     * @throws InvalidArgumentException If the given value isn't a valid VIN.
     */
    public function __construct(string $value)
    {
        // VIN must be in uppercase...
        $value = strtoupper($value);

        if (!preg_match(self::REGEX, $value, $match)) {
            throw new InvalidArgumentException(sprintf(
                'The value "%s" is not a valid VIN',
                $value
            ));
        }

        $this->vin = $value;
        $this->wmi = $match['wmi'];
        $this->vds = $match['vds'];
        $this->vis = $match['vis'];

        $this->region = $this->determineVehicleRegion();
        $this->country = $this->determineVehicleCountry();
        $this->manufacturer = $this->determineVehicleManufacturer();
        $this->modelYear = $this->determineVehicleModelYear();
    }

    /** Gets the VIN **/
    public function getVin() : string
    {
        return $this->vin;
    }

    /** Gets WMI (World Manufacturer Identifier) from the VIN **/
    public function getWmi() : string
    {
        return $this->wmi;
    }

    /** Gets VDS (Vehicle Descriptor Section) from the VIN **/
    public function getVds() : string
    {
        return $this->vds;
    }

    /** Gets VIS (Vehicle Identifier Section) from the VIN **/
    public function getVis() : string
    {
        return $this->vis;
    }

    /** Gets a region from the VIN **/
    public function getRegion() : ?string
    {
        return $this->region;
    }

    /** Gets a country from the VIN **/
    public function getCountry() : ?string
    {
        return $this->country;
    }

    /** Gets a manufacturer from the VIN **/
    public function getManufacturer() : ?string
    {
        return $this->manufacturer;
    }

    /** Gets a model year from the VIN **/
    public function getModelYear() : array
    {
        return $this->modelYear;
    }

    /** Converts the object to array **/
    public function toArray() : array
    {
        return [
            'vin'          => $this->vin,
            'wmi'          => $this->wmi,
            'vds'          => $this->vds,
            'vis'          => $this->vis,
            'region'       => $this->region,
            'country'      => $this->country,
            'manufacturer' => $this->manufacturer,
            'modelYear'    => $this->modelYear,
        ];
    }

    /** Converts the object to string **/
    public function __toString() : string
    {
        return $this->vin;
    }

    /** Tries to determine vehicle region **/
    private function determineVehicleRegion() : ?string
    {
        return REGIONS[$this->wmi[0]]['region'] ?? null;
    }

    /** Tries to determine vehicle country **/
    private function determineVehicleCountry() : ?string
    {
        $countries = REGIONS[$this->wmi[0]]['countries'] ?? null;
        if ($countries === null) {
            return null;
        }

        foreach ($countries as $chars => $name) {
            // there are keys that consist only of numbers...
            $chars = (string) $chars;

            if (strpbrk($this->wmi[1], $chars) !== false) {
                return $name;
            }
        }

        return null;
    }

    /** Tries to determine vehicle manufacturer **/
    private function determineVehicleManufacturer() : ?string
    {
        return MANUFACTURERS[$this->wmi] ?? MANUFACTURERS[$this->wmi[0] . $this->wmi[1]] ?? null;
    }

    /** Tries to determine vehicle model year(s) **/
    private function determineVehicleModelYear() : array
    {

        $comingYear = Carbon::now()->addYears()->format('Y');
        //$comingYear = date('Y') + 1;
        $estimatedYears = [];

        foreach (YEARS as $year => $char) {
            if ($this->vis[0] === $char) {
                $estimatedYears[] = $year;
            }

            if ($comingYear === $year) {
                break;
            }
        }

        return $estimatedYears;
    }
}
