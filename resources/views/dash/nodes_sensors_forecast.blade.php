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
                <form action="{{route('forecast.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="node_id" value="{{$id}}">
                    <div class="row">
                        <div class="col-12 col-xs-6 mb-3">
                            <div class="form-group mb-4">
                                <label>Parameter</label>
                                <select class="form-control" name="parameter" id="" required>
                                    <option value="co2">Carbon Dioxide (CO2)</option>
                                    <option value="co">Carbon Monoxide (CO)</option>
                                    <option value="ch4">Metana (CH4)</option>
                                    <option value="temperature">Temperature (°C)</option>
                                    <option value="humidity">Humidity(%)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-xs-6 mb-3">
                            <div class="form-group mb-4">
                                <label>Forecast Duration</label>
                                <select class="form-control" name="duration" id="" required>
                                    <option value="daily">Daily (result per hour and sample based yesterday)</option>
                                    <option value="weekly">Weekly (result per day and sample based last 7 days)</option>
                                    <option value="monthly">Monthly (result per day and sample based last 30 days)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-md btn-primary">Forecast</button>
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
                @if (session('latestIndex'))
                <canvas id="forecast-report" class="mt-4" style="height:500px;"></canvas>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
