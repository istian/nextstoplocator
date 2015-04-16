<?php namespace App\TransportStation\Repositories;

use App\TransportStation\Repositories\Eloquent\AbstractStationLocatorRepository;

/**
 * Class BusStationLocatorRepository
 *
 * Concrete Repository class for abstracting operation involving \Modes\Station
 * @package App\TransportStation\Repositories
 */
class BusStationLocatorRepository extends AbstractStationLocatorRepository
{

    /**
     * Returns Eloquent model for this Repository class
     * @return string
     */
    function getModel()
    {
        return "App\\TransportStation\\Models\\Station";
    }
}