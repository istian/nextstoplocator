<?php namespace App\TransportStation\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ORM for Bus
 * @package App\TransportStationLocator\Models
 */
class Bus extends Model
{

    protected $table = 'buses';

    protected $fillable = ['name', 'station_id', 'arrival'];

    /**
     * Method that defines child relationship to Station model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function station() {
        return $this->belongsTo('App\\TransportStation\\Models\Station');
    }

}
