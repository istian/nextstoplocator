<?php namespace App\TransportStation\Repositories\Eloquent;

/**
 * Class AbstractStationRepository
 *
 * Abstract for implementing and defining basic Station Repository class
 * @package App\TransportStation\Repositories\Eloquent
 */
abstract class AbstractStationRepository
{

    /**
     * Returns station calculated distance from currently logged in user
     * @return string $distance
     */
    public function getDistance() {
        return $this->station->distance;
    }

    /**
     * Returns list of transporation, with arrival information, that belongs to this station
     * @return Collection
     */
    abstract function getListTransportation();
}