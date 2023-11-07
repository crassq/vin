<?php

namespace Crassq\Vin\Services;

use Exception;

class RegionService
{

    /**
     * @param string $wmi
     * @return string
     * @throws Exception
     */
    public function getRegionFromWmi(string $wmi): string
    {
        $character = $wmi[0];

        return match ($character) {
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H' => trans('vin_messages.region.Africa'),
            'J', 'K', 'L', 'M', 'N', 'P', 'R' => trans('vin_messages.region.Asia'),
            'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' => trans('vin_messages.region.Europe'),
            '1', '2', '3', '4', '5' => trans('vin_messages.region.North_America'),
            '6', '7' => trans('vin_messages.region.Oceania'),
            '8', '9', '0' => trans('vin_messages.region.South_America'),
            default => throw new Exception(trans('vin_messages.region.Invalid')),
        };
    }
}
