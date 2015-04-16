<?php namespace App\TransportStation\Repositories\Queries;


use App\TransportStation\Repositories\Eloquent\AbstractStationLocatorRepository as LocatorRepository;

class DistanceQuery extends AbstractQuery
{

    private $radius = 10; // miles

    private $earthMeanRadius = 3960; // miles

    /**
     * @param $radius
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;
    }

    /**
     * @return int
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Modify/add custom distance query condition to Repository model
     *
     * This method calculate min lat and lon relative to the current user lat and lon
     * and use the values to short list stations near to current user
     * @param $model
     * @param LocatorRepository $repository
     */
    public function apply($model, LocatorRepository $repository)
    {

        $lat = $repository->user()->lat;
        $lon = $repository->user()->lon;
        $degreesQueryRadius = rad2deg($this->radius / $this->earthMeanRadius);
        $degreesLongQueryRadius = rad2deg($this->radius / $this->earthMeanRadius / cos(deg2rad($lat)));

        $maxLat = number_format((float) ($lat + $degreesQueryRadius), 6, '.', '');
        $minLat = number_format((float) ($lat - $degreesQueryRadius), 6, '.', '');
        $maxLon = number_format((float) ($lon + $degreesLongQueryRadius), 6, '.', '');
        $minLon = number_format((float) ($lon - $degreesLongQueryRadius), 6, '.', '');
//        dd("$minLon|$maxLon\n$minLat|$maxLat");

        return $model->whereRaw(
            "lon BETWEEN $minLon AND $maxLon AND lat BETWEEN $minLat AND $maxLat"
        )->orderBy(\DB::raw("(POW((lon-($lon)),2) + POW((lat-($lat)),2))"), "DESC");

    }
}