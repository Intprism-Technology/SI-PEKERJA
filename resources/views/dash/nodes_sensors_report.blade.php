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
                    <table class="data-table data-table-nodeReport responsive">
                        <thead>
                            <tr>
                                <th>Datetime</th>
                                <th>Node ID</th>
                                <th>Owned</th>
                                <th>Btn Warn</th>
                                <th>CO2</th>
                                <th>CO</th>
                                <th>CH4</th>
                                <th>Tmp</th>
                                <th>Hum</th>
                                <th>Lat</th>
                                <th>Lng</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
