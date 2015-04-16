<?php namespace App\TransportStation\Models;

use App\TransportStation\Repositories\Contracts\DiscoverableInterface;
use App\TransportStation\Repositories\Traits\DiscoverableTrait;
use Illuminate\Database\Eloquent\Model;
/**
 * ORM for Station
 * @traits
 * @package App\TransportStationLocator\Models
 */
class Station extends Model implements DiscoverableInterface
{
    use DiscoverableTrait;

    protected $table = 'stations';

    protected $fillable = ['name', 'address', 'description', 'lat', 'lon'];

    /** @var $appends array Model property that contains mutator */
    protected $appends = ['distance', 'bus_count'];

    /**
     * Method that defines parent relationship to Bus Model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buses() {
        return $this->hasMany('App\\TransportStation\\Models\Bus');
    }

    /**
     * Model mutator attribute
     *
     * Returns count of buses belongs to this model
     * @return mixed
     */
    public function getBusCountAttribute() {
        return $this->buses()->count();
    }

}
