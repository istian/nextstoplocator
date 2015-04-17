<?php
/**
 * This Interface class defines required methods for Repository class to support Query modification
 */
namespace App\TransportStation\Repositories\Contracts;

use App\TransportStation\Repositories\Queries\AbstractQuery as Query;

interface QueryableInterface
{
    /**
     * Method for adding custom query conditions
     * @param Query $criteria
     * @return mixed
     */
    public function addQuery(Query $criteria);

    /**
     * Method for skipping custom query conditions
     * @return mixed
     */
    public function resetQuery();

    /**
     * Method for applying/appending custom condition to query
     * @return mixed
     */
    public function applyQuery();
}