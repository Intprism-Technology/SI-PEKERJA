@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>{{ucfirst(explode('.', Route::currentRouteName())[0])}} - {{$id}}</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                <div class="alert alert-info mt-4" role="alert">
                    Semakin banyak rentang waktu, semakin lama proses loading untuk track pengguna !
                </div>
                <form action="{{route('track.data')}}" method="post">
                    @csrf
                    <input type="hidden" name="node_id" value="{{$id}}">
                    <div class="row">
                        <div class="col-12 col-xs-6 mb-3">
                            <div class="form-group mb-4">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12 col-xs-6 mb-3">
                            <div class="form-group mb-4">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-md btn-primary">Track</button>
                    </div>
                </form>
                @if (session('success'))
                    <div class="alert alert-success mt-4 text-center" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('danger'))
                    <div class="alert alert-danger mt-4 text-center" role="alert">
                        {{ session('danger') }}
                    </div>
                @endif
                @if (session('data'))
                <div id="map" style="height: 500px" class="mt-4"></div>
                <style>
                    .markerLabel b{
                        display: block;
                        width: 200px;
                        margin-top: 5px;
                        color: #f00;
                    }
                </style>
                <script>
                    var pointsForJson = [
                    
                    @foreach(session('data') as $data)
                    [{{$data->lng}}, {{$data->lat}}, "{{$data->created_at}}"],
                    @endforeach
                    ];

                    var map = L.map('map');
                    L.marker(lngLatToLatLng(pointsForJson[0])).addTo(map);
                    L.marker(lngLatToLatLng(pointsForJson[0]), {
                    icon: L.divIcon({
                        html: "<b>[Start] "+pointsForJson[0][2]+"</b>",
                        className: 'markerLabel',
                        })
                    }).addTo(map);
                    L.marker(lngLatToLatLng(pointsForJson.at(-1))).addTo(map);
                    L.marker(lngLatToLatLng(pointsForJson.at(-1)), {
                    icon: L.divIcon({
                        html: "<b>[Stop] "+pointsForJson.at(-1)[2]+"</b>",
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
