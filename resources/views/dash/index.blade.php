@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>{{ucfirst(explode('.', Route::currentRouteName())[0])}}</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            </nav>
            <div class="separator mb-5"></div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="icon-cards-row">
                <div class="glide dashboard-numbers">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <li class="glide__slide">
                                <a href="{{route('alerts.index')}}" class="card">
                                    <div class="card-body text-center progress-banner ">
                                        <i class="iconsminds-clock text-white"></i>
                                        <p class="card-text mb-0 text-white">Status</p>
                                        <p class="lead text-center text-white">
                                            @php
                                                try {
                                            @endphp
                                            @if($status->type == 0)
                                                Warning
                                            @elseif($status->type == 1)
                                                Danger
                                            @endif
                                            @php
                                                } catch (\Throwable $th) {
                                                    //throw $th;
                                                    echo "Normal";
                                                }
                                            @endphp
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="{{route('nodes.index')}}" class="card">
                                    <div class="card-body text-center progress-banner">
                                        <i class="iconsminds-router text-white"></i>
                                        <p class="card-text mb-0 text-white">Total Nodes</p>
                                        <p class="lead text-center text-white">{{$nodes}}</p>
                                    </div>
                                </a>
                            </li>
                            <li class="glide__slide">
                                <a href="{{route('nodes.index')}}" class="card">
                                    <div class="card-body text-center progress-banner">
                                        <i class="iconsminds-communication-tower-2 text-white"></i>
                                        <p class="card-text mb-0 text-white">Nodes Connected</p>
                                        <p class="lead text-center text-white">{{$nodesConnected}}</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="position-absolute card-top-buttons">

                            <button class="btn btn-header-light icon-button" type="button" >
                                <i class="simple-icon-refresh"></i>
                            </button>

                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Alert Stats</h5>
                            <div class="dashboard-line-chart chart">
                                <canvas id="salesChartt"></canvas>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card">
                <div class="position-absolute card-top-buttons">
                    <button class="btn btn-header-light icon-button">
                        <i class="simple-icon-refresh"></i>
                    </button>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Recent Alerts</h5>
                    <div class="scroll dashboard-list-with-thumbs">
                        @foreach($alerts as $alert)
                        <div class="d-flex flex-row mb-3">
                            <a class="d-block position-relative" href="{{route('alerts.index')}}">
                                @if($alert->type == 0)
                                <img src="{{asset('img/warning.png')}}" class="list-thumbnail border-0" />
                                <span class="badge badge-pill badge-theme-2 position-absolute badge-top-right">Warning</span>
                                @else
                                <img src="{{asset('img/danger.png')}}" class="list-thumbnail border-0" />
                                <span class="badge badge-pill badge-theme-2 position-absolute badge-top-right">Danger</span>
                                @endif
                            </a>
                            <div class="pl-3 pt-2 pr-2 pb-2">
                                <a href="{{route('alerts.index')}}">
                                    <p class="list-item-heading">
                                        @php
                                        $variable = "";
                                        foreach(json_decode($alert->variable) as $alertVar){
                                            $variable .= $alertVar . ', ';
                                        }
                                        @endphp
                                        {{substr($variable,0,-2)}}
                                    </p>
                                    <div class="pr-4 d-none d-sm-block">
                                        <p class="text-muted mb-1 text-small">
                                            Indicated in nodes <a href="{{route('nodes.show', $alert->nodes)}}">{{$alert->nodes}}</a>
                                            @if($alert->status == 0)
                                            <span class="badge badge-pill badge-danger">Not Solved</span>
                                            @else
                                            <span class="badge badge-pill badge-success">Solved</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-primary text-small font-weight-medium d-none d-sm-block">{{$alert->created_at}}</div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="map" style="height: 800px"></div>
<style>
    .markerLabel b{
        display: block;
        width: 130px;
        margin-top: 5px;
        color: #f00;
    }
</style>
<script>
    var pointsForJson = [
  [5.58611, 43.296665, '2022'],
  [5.614466, 43.190604, '2022'],
  [5.565922, 43.254726, '2022'],
  [5.376992, 43.302967, '2022']
];

var map = L.map('map');

// pointsForJson.forEach(function(lngLat) {
//   L.marker(lngLatToLatLng(lngLat)).addTo(map);
// });
L.marker(lngLatToLatLng(pointsForJson[0])).addTo(map);
L.marker(lngLatToLatLng(pointsForJson[0]), {
  icon: L.divIcon({
      html: "<b>2022-08-25 11:37:11</b>",
      className: 'markerLabel',
    })
}).addTo(map);
L.marker(lngLatToLatLng(pointsForJson.at(-1))).addTo(map);
L.marker(lngLatToLatLng(pointsForJson.at(-1)), {
  icon: L.divIcon({
      html: "<b>2022-08-25 11:37:11</b>",
      className: 'markerLabel',
    })
}).addTo(map);

var polyline = L.polyline(lngLatArrayToLatLng(pointsForJson)).addTo(map);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

map.fitBounds(polyline.getBounds());

function lngLatArrayToLatLng(lngLatArray) {
  return lngLatArray.map(lngLatToLatLng);
}

function lngLatToLatLng(lngLat) {
  return [lngLat[1], lngLat[0]];
}
</script>

@endsection
