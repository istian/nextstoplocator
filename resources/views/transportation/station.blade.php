@extends('app')

@section('content')
    <div class="list-wrapper" ng-controller="TransportationController">
        <div class="container" station-view="true">
            @foreach(array_chunk($stations->all(), 3) as $row)
                <div class="row">
                    @foreach($row as $station)
                        <div class="col-md-4">

                            <div class="card hovercard">
                                <div class="cardheader" style="background-image: url({{$station->image}});">
                                </div>
                                <div class="station-name">
                                    <h3>{{$station['name']}}</h3>
                                </div>
                                <div class="info">
                                    <p><span class="label label-info"><i class="fa fa-map-marker"></i>
                                                                            Address:</span> <strong>{{$station['address']}}</strong></p>

                                </div>
                                <div class="bottom clearfix">
                                    <div class="transpo-info clearfix">
                                        <span class="pull-left distance"><i class="fa fa-compass"></i>
                                        <strong>{{$station['distance']}}</strong></span>
                                        <a href="javascript://" data-info-url="/station/{{$station['id']}}"
                                           data-station-id="{{$station['id']}}"
                                           class="btn btn-primary get-trans-info pull-right"><i
                                                    class="fa fa-bus"></i> {{$station['bus_count']}}</a>
                                    </div>
                                    <div class="transpo-info-panel hidden">
                                        <ul class="list-group transport-list">
                                            <li class="list-group-item"
                                                ng-repeat="(key, vehicle) in transportInfo[{{$station['id']}}]">
                                                <span class="label label-success pull-right"><i class="fa fa-clock-o"></i> <% vehicle.arrival %></span>
                                                <i class="fa fa-bus"></i><% vehicle.name %>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                    @endforeach
                </div>
            @endforeach

            <div class="row">
                <div class="pull-right">
                    {!! $stations->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection