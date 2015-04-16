<?php
/**
 * This Interface class defines required methods for Repository class to support Query modification
 */
namespace App\TransportStation\Repositories\Contracts;

use App\TransportStation\Repositories\Queries\AbstractQuery as Query;

interface QueryableInterface
{
    public function addQuery(Query $criteria);

    public function resetQuery();

    public function applyQuery();
}