<?php namespace App\Http\Controllers;

use App\TransportStation\Repositories\BusStationLocatorRepository as BusStation;
use App\TransportStation\Repositories\Queries\DistanceQuery as DistanceFilter;

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */
    private $stationLocator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusStation $stationLocator)
    {
        $this->middleware('auth');

        $this->stationLocator = $stationLocator;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
//        $stations = $this->stationLocator->addQuery(new DistanceFilter())->getNearbyStations();
//        dd($stations);
//        $stations = $this->stationLocator->getNearbyStations();
//        dd($stations);
        dd($this->stationLocator->getNearbyStations());
        return view('home', compact('stations'));
    }

}
