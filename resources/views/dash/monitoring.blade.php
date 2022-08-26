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
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body ">
                    <h5 class="mb-4">Threshold</h5>
                    <div class="alert alert-danger" role="alert">
                        <table>
                            <tr>
                                <td>CO2</td>
                                <td>&nbsp;&nbsp;: {{$setting->co2}} PPM</td>
                            </tr>
                            <tr>
                                <td>CO</td>
                                <td>&nbsp;&nbsp;: {{$setting->co}} PPM</td>
                            </tr>
                            <tr>
                                <td>CH4</td>
                                <td>&nbsp;&nbsp;: {{$setting->ch4}} PPM</td>
                            </tr>
                            <tr>
                                <td>Temperature</td>
                                <td>&nbsp;&nbsp;: {{$setting->temperature}} °C</td>
                            </tr>
                            <tr>
                                <td>Humidity</td>
                                <td>&nbsp;&nbsp;: {{$setting->humidity}} %</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body ">
                    <h5 class="mb-4">Alert Monitoring</h5>
                    <h1 class="mt-3">
                        @if($alertAvailable)
                            @if($alert->type == 0)
                            <span class="badge blink_alert badge-warning">Warning</span>
                            @elseif($alert->type == 1)
                            <span class="badge blink_alert badge-danger">Danger</span>
                            @endif
                        @else
                            <span class="badge badge-success">Normal</span>
                        @endif
                        <style>
                            .blink_alert {
                                animation: blinker 1s linear infinite;
                            }

                            @keyframes blinker {
                                50% {
                                    opacity: 0;
                                }
                            }

                        </style>
                    </h1>
                    <div id="params-overtreshold" class="mt-2">Over Threshold : 
                        <b class="text-danger">
                        @if($alertAvailable)
                            @if($alertVar->co2 ?? false)
                                CO2: {{$alertVar->co2}} PPM; CO: {{$alertVar->co}} PPM;CH4: {{$alertVar->ch4}} PPM; Tmp: {{$alertVar->temperature}} °C; Hum: {{$alertVar->humidity}} %
                            @else
                            -
                            @endif
                        @else
                        -
                        @endif
                        </b></div>
                    <div id="nodes-overtreshold">Nodes Indicated: <b class="text-danger"><a href="{{route('nodes.show',$alert->nodes ?? 0)}}" class="text-danger">{{$alert->nodes ?? '-'}}</a></b></div>
                    <div id="timer-monitoring"></div>
                    <script>
                        var timeInSecs;
                        var ticker;
                        var elem = document.getElementById('timer-monitoring');
                        var audio;

                        function alertSound(status) {
                            if (status == 'danger') {
                                var audio = new Audio('/music/danger.mp3');
                            } else if (status == 'warning') {
                                var audio = new Audio('/music/warning.mp3');
                            }
                            audio.play();
                        }
                        @if($alertAvailable)
                            @if($alert->type == 0)
                            alertSound("warning");
                            @else
                            alertSound("danger");
                            @endif
                        @endif

                        function refreshResult() {
                            elem.innerHTML = 'checking possible indications...';
                            location.reload();
                        }

                        function startTimer(secs) {
                            timeInSecs = parseInt(secs);
                            ticker = setInterval("tick()", 1000);
                        }

                        function tick() {
                            var secs = timeInSecs;
                            if (secs == -1) {
                                clearInterval(ticker);
                                refreshResult();
                                startTimer(10);
                            } else {
                                elem.innerHTML = timeInSecs + ' seconds remaining to refresh status...';
                                timeInSecs--;
                            }
                        }
                        startTimer(10);

                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        @if($hasManualAlert->count() == 0)
        <button class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target="#manualAlertSend">Send Manual Alert</button>
        @else
        <form action="{{route('alerts.update', $hasManualAlert->first()->id)}}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" value="1" name="status">
            <button class="btn btn-danger" type="submit">Stop Manual Alert</button>
        </form>
        @endif
        <div class="modal fade modal-right" id="manualAlertSend" tabindex="-1" role="dialog"
            aria-labelledby="manualAlertSend" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Manual Alert</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{route('alerts.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Alert Type</label>
                                <select class="form-control" name="type" required>
                                    <option value="0">Warning</option>
                                    <option value="1">Danger</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Over Threshold</label>
                                <div class="custom-control custom-checkbox text-left">
                                    <input type="checkbox" class="custom-control-input" id="CO2" name="co2">
                                    <label class="custom-control-label" for="CO2">CO2</label>
                                </div>
                                <div class="custom-control custom-checkbox text-left">
                                    <input type="checkbox" class="custom-control-input" id="CO" name="co">
                                    <label class="custom-control-label" for="CO">CO</label>
                                </div>
                                <div class="custom-control custom-checkbox text-left">
                                    <input type="checkbox" class="custom-control-input" id="CH4" name="ch4">
                                    <label class="custom-control-label" for="CH4">CH4</label>
                                </div>
                                <div class="custom-control custom-checkbox text-left">
                                    <input type="checkbox" class="custom-control-input" id="TmpHum" name="tmp_hum">
                                    <label class="custom-control-label" for="TmpHum">Tmp + Hum</label>
                                </div>
                            </div>
                            Note: create this alert required to manual stop alert too.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
