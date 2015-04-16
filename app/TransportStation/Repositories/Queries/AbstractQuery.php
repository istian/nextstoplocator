<?php namespace App\TransportStation\Repositories\Queries;

use App\TransportStation\Repositories\Eloquent\AbstractStationLocatorRepository as LocatorRepository;

/**
 * Class AbstractQuery
 *
 * Base class for implementing custom Query class for modifying Repository model query
 * @package App\TransportStation\Repositories\Queries
 */
abstract class AbstractQuery
{

    /**
     * Modify
     * @param $model
     * @param LocatorRepository $repository
     * @return mixed
     */
    abstract public function apply($model, LocatorRepository $repository);
}