<?php declare(strict_types=1);

/**
 * @author Richard Simard <richard.simard@crassq.ca>
 * @copyright Copyright (c) 2025 CRASSQ
 * @license https://github.com/crassq/vin/blob/master/LICENSE
 * @link https://github.com/crassq/vin
 */

namespace CRASSQ\Vin;

/**
 * Vehicle Identification Number
 *
 * @link https://en.wikipedia.org/wiki/Vehicle_identification_number
 * @link https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)
 */
interface VinInterface
{

    /**
     * Gets the VIN
     *
     * @return string
     */
    public function getVin() : string;

    /**
     * Gets WMI (World Manufacturer Identifier) from the VIN
     *
     * @return string
     */
    public function getWmi() : string;

    /**
     * Gets VDS (Vehicle Descriptor Section) from the VIN
     *
     * @return string
     */
    public function getVds() : string;

    /**
     * Gets VIS (Vehicle Identifier Section) from the VIN
     *
     * @return string
     */
    public function getVis() : string;

    /**
     * Gets a region from the VIN
     *
     * @return string|null
     */
    public function getRegion() : ?string;

    /**
     * Gets a country from the VIN
     *
     * @return string|null
     */
    public function getCountry() : ?string;

    /**
     * Gets a manufacturer from the VIN
     *
     * @return string|null
     */
    public function getManufacturer() : ?string;

    /**
     * Gets a model year from the VIN
     *
     * @return list<int>
     */
    public function getModelYear() : array;
}
