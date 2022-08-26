@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>{{ucfirst(explode('.', Route::currentRouteName())[0])}}</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            </nav>
            <div class="separator mb-5"></div>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <table class="data-table data-table-alert responsive">
                        <thead>
                            <tr>
                                <th>Datetime</th>
                                <th>Type</th>
                                <th>Variable</th>
                                <th>Indicated Node</th>
                                <th>Status</th>
                                <th>Solved Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alerts as $alert)
                            <tr>
                                <td>{{$alert->created_at}}</td>
                                @if($alert->type == 0)
                                <td class="text-warning">Warning</td>
                                @else
                                <td class="text-danger">Danger</td>
                                @endif
                                <td>
                                    @php
                                        $variable = "";
                                        foreach(json_decode($alert->variable) as $alertVar){
                                            $variable .= $alertVar . ', ';
                                        }
                                    @endphp
                                    {{substr($variable,0,-2)}}
                                </td>
                                <td><a href="{{route('nodes.show', $alert->nodes)}}">{{$alert->nodes}}</a></td>
                                @if($alert->status == 1)
                                <td><span class="badge badge-sm badge-success">Solved</span></td>
                                <td>{{$alert->updated_at}} - ({{round((strtotime($alert->updated_at->toDateTimeString()) - strtotime($alert->created_at->toDateTimeString())) / 60,2)}} minutes)</td>
                                <td>-</td>
                                @else
                                <td><span class="badge badge-sm badge-danger">Not Solved</span></td>
                                <td>-</td>
                                <td><a href="{{route('alerts.edit', $alert->id)}}" class="btn btn-md btn-primary">Set as Solved</a></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
