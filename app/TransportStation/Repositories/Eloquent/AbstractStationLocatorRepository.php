<?php namespace App\TransportStation\Repositories\Eloquent;

use App\TransportStation\Repositories\Contracts\QueryableInterface;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection as Collection;
use App\TransportStation\Repositories\Contracts\LocatorRepositoryInterface;
use App\TransportStation\Repositories\Queries\AbstractQuery as Query;

/**
 * Abstract Station Repository class that implements base methods that returns Station list
 * @package App\TransportStation\Repositories\Eloquent
 */
abstract class AbstractStationLocatorRepository implements LocatorRepositoryInterface, QueryableInterface
{

    /** @var $app Laravel service container*/
    private $app;

    /** @var $user Current logged in user */
    private $user;

    /** @var $criteria a collection that will hold custom query conditions */
    protected $criteria;

    /** @var $model the abstracted Eloquent model */
    protected $model;

    /** @var $querySkip boolean flag for skipping custom applied query condition */
    protected $querySkip = false;

    /**
     * Abstract method that will return class namespace to be instantiated and use by this Repository class
     */
    abstract function getModel();

    /**
     * @param Collection $collection
     * @param App $app
     */
    public function __construct(App $app, Collection $collection)
    {
        $this->app = $app;
        $this->criteria = $collection;
        $this->user = \Auth::user();
        $this->makeModel();
    }

    /**
     * This method is called upon instantiation to identify what model this Repository class will contain.
     *
     * For this Reposistory, model property is an abstration of Eloquent Station model
     * @return mixed
     */
    public function makeModel()
    {
        return $this->model = $this->app->make($this->getModel());
    }

    /**
     * This method returns list of nearby transportation terminal to current logged in user
     *
     * @param int $page
     * @param int $perPage
     * @return Collection $results
     */
    public function getNearbyStations($page, $perPage = 9)
    {
        // make sure custom query condition is applied
        $this->applyQuery();

        /** @var results contains the paginated collections */
        $results = new \stdClass;
        $results->page = $page;
        $results->limit = $perPage;
        $results->totalItems = 0;
        $results->items = array();
        $results->totalItems = $this->model->count();

        $users = $this->model->skip($perPage * ($page - 1))->take($perPage)->get();

        $results->items = $users->all();

        return $results;
    }


    /**
     * Method for adding custom query conditions
     *
     * @param Query $query
     * @return $this
     */
    public function addQuery(Query $query)
    {
        $this->criteria->push($query);
        return $this;
    }

    /**
     * Method that will skip added custom query condition
     * @return $this
     */
    public function resetQuery()
    {
        $this->querySkip = true;
        return $this;
    }

    /**
     * Method that will add custom query condition for the model query statement
     * @return $this
     */
    public function applyQuery()
    {

        if ($this->querySkip) {
            return $this;
        }

        foreach($this->criteria as $query) {
            if ($query instanceof Query) {
                $this->model = $query->apply($this->model, $this);
            }
        }

        return $this;
    }

    /**
     * Getter for user property
     * @return Current
     */
    public function user() {
        return $this->user;
    }

}