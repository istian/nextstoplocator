<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TransportStation\Repositories\BusStationLocatorRepository as BusStations;
use App\TransportStation\Repositories\Queries\DistanceQuery as DistanceFilter;

use App\TransportStation\Repositories\BusStationRepository as BusStation;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;


class TransportationController extends Controller
{

    private $stationLocator;

    public function __construct(BusStations $stationLocator)
    {
        $this->middleware('auth');

        $this->stationLocator = $stationLocator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $page = Input::get('page', 1);
        $perPage = 9;

        $data = $this->stationLocator
            ->addQuery(new DistanceFilter())
            ->getNearbyStations($page, $perPage);

        $stations = new Paginator($data->items, $data->totalItems, $perPage, $page, [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]);

        return view('transportation/station', compact('stations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function showTransporations($id)
    {
        $busStation = new BusStation($id);
        return Response::JSON($busStation->getListTransportation());
    }

}
