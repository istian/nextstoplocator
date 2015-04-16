<?php namespace App\TransportStation\Repositories\Traits;

/**
 * Class DiscoverableTrait
 *
 * Used by DB models to add a mutator or custom attribute.
 * @package App\TransportStation\Repositories\Traits
 */
trait DiscoverableTrait
{
    /**
     * This method servers as mutators for Eloquent models that calculate distance from current user location.
     * @return string
     */
    public function getDistanceAttribute()
    {
        $lat1 = $this->lat;
        $lon1 = $this->lon;
        $lat2 = \Auth::user()->lat ?: 0;
        $lon2 = \Auth::user()->lon ?: 0;

        $degrees = rad2deg(acos((sin(deg2rad($lat1))*sin(deg2rad($lat2))) + (cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($lon1-$lon2)))));

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        $distanceKm = $degrees * 111.13384;
        $distanceM = $degrees * 69.05482;
        $distanceNm = $degrees * 59.97662;

        switch(true) {
            case ($distanceM <= 69.05482):
                $distance = $distanceKm;
                $unit = 'km';
                break;
            case ($distanceNm <= 59.97662):
                $distance = $distanceM;
                $unit = 'm';
                break;
            default:
                $distance = $distanceNm;
                $unit = 'nm';
                break;
        }
        return round($distance, 2) . $unit;
    }
}