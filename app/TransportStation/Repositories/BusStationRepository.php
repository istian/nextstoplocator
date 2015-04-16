<?php namespace App\TransportStation\Repositories;

use App\TransportStation\Repositories\Eloquent\AbstractStationRepository;
use App\TransportStation\Models\Station;

/**
 * Class BusStationRepository
 *
 * A concrete Repository class for abstrating operation involving \Models\Station and related Eloquent models
 * @package App\TransportStation\Repositories
 */
class BusStationRepository extends AbstractStationRepository
{

    /**
     * This method retrieves Station data and assign collection to this Repository
     * @param $id
     */
    public function __construct($id) {
        $this->station = Station::with('Buses')->find(array("id"=>$id))->first();
    }

    /**
     * This method retrieves list of buses belongs to current transporation terminal
     * @return mixed
     */
    public function getListTransportation()
    {
        return $this->station->buses->toArray();
    }
}