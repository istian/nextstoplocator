<?php
/**
 * This Interface defines rules for class/entities that needs distance calculation
 */

namespace App\TransportStation\Repositories\Contracts;

interface DiscoverableInterface
{
    /**
     * Returns distance (Km/M/Nm) from Auth::user() lat and lon values
     * @param string $unit
     * @return mixed
     */
    public function getDistanceAttribute();
}