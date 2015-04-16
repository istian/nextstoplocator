<?php namespace App\TransportStation\Repositories\Contracts;


/**
 * Interface LocatorInterface
 *
 * Defines required methods for LocatorRepository classes
 * @package Transport\Repositories\Contracts
 */
interface LocatorRepositoryInterface
{
    /**
     * Returns nearby terminal/transporation station nearby user location
     * @return Collection
     */
    public function getNearbyStations($page, $perPage = 15);

}