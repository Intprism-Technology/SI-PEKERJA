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
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Threshold Setting</h5>
            <form action="{{route('settings.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-xs-6 mb-3">
                    <div class="form-group mb-4">
                        <label>CO2 (PPM)</label>
                        <input type=number step=0.01 class="form-control" value="{{$setting->co2}}" name="co2" required>
                    </div>
                    <div class="form-group mb-4">
                        <label>CO (PPM)</label>
                        <input type=number step=0.01 class="form-control" value="{{$setting->co}}" name="co" required>
                    </div>
                    <div class="form-group mb-4">
                        <label>CH4 (PPM)</label>
                        <input type=number step=0.01 class="form-control" value="{{$setting->ch4}}" name="ch4" required>
                    </div>
                </div>
                <div class="col-12 col-xs-6 mb-3">
                    <div class="form-group mb-4">
                        <label>Temperature (°C)</label>
                        <input type=number step=0.01 class="form-control" value="{{$setting->temperature}}" name="temperature" required>
                    </div>
                    <div class="form-group mb-4">
                        <label>Humidity (%)</label>
                        <input type=number step=0.01 class="form-control" value="{{$setting->humidity}}" name="humidity" required>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-md btn-primary">Save Changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
