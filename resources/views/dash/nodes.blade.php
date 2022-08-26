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
                    <table class="data-table data-table-nodes responsive">
                        <thead>
                            <tr>
                                <th>Node ID</th>
                                <th>Owned</th>
                                <th>Latest Connected</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nodes as $node)
                            <tr>
                                <td>{{$node->node_id}}</td>
                                <td>{{$owner::where('node_id', $node->node_id)->first()->owner ?? '-'}}</td>
                                <td>{{$node->created_at}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{route('nodes.show', $node->node_id)}}">Sensor
                                        Report</a>
                                    <a href="{{route('forecast.show', $node->node_id)}}" class="btn btn-info" data-dismiss="modal">Forecast</a>
                                    <a class="btn btn-sm btn-success" href="{{route('track.index', $node->node_id)}}">GPS Track</a>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editOwner"
                                        onclick="editFunction('{{$node->node_id}}')">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="editOwner" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editOwner">Edit Owner</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('nodes.storeLabel')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="node-id" class="col-form-label">Node ID:</label>
                                            <input type="text" class="form-control" id="node-id" name="node_id" required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="owner-name" class="col-form-label">Owner Name:</label>
                                            <input type="text" class="form-control" id="message-text" name="owner">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        function editFunction(val) {
                            document.getElementById('node-id').value = val;
                        }

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
