<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NodesReport;
use App\Models\NodesLabel;
use App\Models\Setting;
use App\Models\Alert;
use Yajra\DataTables\Facades\DataTables;

class NodesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = NodesReport::orderBy('created_at', 'DESC')->get()->unique('node_id');
        $owner = new NodesLabel;
        return view('dash.nodes', compact(
            'nodes',
            'owner'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // check threshold
            $setting = Setting::first();
            $threshold['co'] = 0;
            $threshold['ch4'] = 0;

            $variable = array();
            if ($request->gas['co2'] > $setting->co2) {
                array_push($variable, "CO2");
            }
            if ($request->gas['co'] > $setting->co) {
                $threshold['co'] = 1;
                array_push($variable, "CO");
            }
            if ($request->gas['ch4'] > $setting->ch4) {
                $threshold['ch4'] = 1;
                array_push($variable, "CH4");
            }
            if ($request->dht['temperature'] > $setting->temperature) {
                array_push($variable, "Temperature");
            }
            if ($request->dht['humidity'] > $setting->humidity) {
                array_push($variable, "Humidity");
            }
            if ($threshold['co'] == 1 AND $threshold['ch4'] == 1) {
                $type = 1;
            }else {
                $type = 0;
            }
            
            //jika var sama, status 0
            $filterIfAlertExist = Alert::where('variable',json_encode($variable))->where('status', 0)->count();
            if($filterIfAlertExist == 0){
                // set solved old alert
                try {
                    Alert::where('nodes', $request->node['id'])->where('status', 0)->update([
                        'status' => 1
                    ]);
                } catch (\Throwable $th) {
                    //throw $th;
                }
                if($variable != []){
                    // store new alert
                    $alert = Alert::create([
                        'type' =>$type,
                        'variable' =>json_encode($variable),
                        'nodes' => $request->node['id'],
                        'status' => 0,
                    ]);
                }
            }
            $report = NodesReport::create([
                'alert_id' => $alert->id ?? NULL,
                'node_id' => $request->node['id'],
                'btn_warn' => $request->node['emergency'],
                'co2' => $request->gas['co2'],
                'co' => $request->gas['co'],
                'ch4' => $request->gas['ch4'],
                'temperature' => $request->dht['temperature'],
                'humidity' => $request->dht['humidity'],
                'lat' => $request->gps['latitude'],
                'lng' => $request->gps['longitude'],
            ]);
            // get alert status
            $alert = Alert::where('status', 0)->orderBy('type', 'DESC')->first();
            return ([
                'status' => 'success',
                'data' => $report,
                'alert' => $alert ?? NULL
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return ([
                'status' => 'failed',
                'msg' => $th->getMessage()
            ]);
        }
    }
    public function storeLabel(Request $request)
    {
        NodesLabel::updateOrCreate([
            'node_id' =>$request->node_id
        ],[
            'node_id' => $request->node_id,
            'owner' => $request->owner
        ]);
        return redirect()->back()->with('success', "Success Update Owner Node !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dash.nodes_sensors_report', compact(
            'id'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function reportAjax($id){
        $result = NodesReport::join('nodes_reports', 'nodes_labels.node_id', '=', 'nodes_reports.node_id')->get(
            [
                'nodes_reports.alert_id',
                'nodes_reports.node_id',
                'nodes_labels.owner',
                'nodes_reports.btn_warn',
                'nodes_reports.co2',
                'nodes_reports.co',
                'nodes_reports.ch4',
                'nodes_reports.temperature',
                'nodes_reports.humidity',
                'nodes_reports.lat',
                'nodes_reports.lng',
                'nodes_reports.created_at',
            ]
        );
        $akhir = array();
        foreach($result as $index=>$data){
            $akhir[$index]['alert_id'] = $data->alert_id ?? NULL;
            $akhir[$index]['node_id'] = $data->node_id;
            $akhir[$index]['owner'] = $data->owner;
            $akhir[$index]['btn_warn'] = $data->btn_warn;
            $akhir[$index]['co2'] = round($data->co2,2)." PPM";
            $akhir[$index]['co'] = round($data->co,2)." PPM";
            $akhir[$index]['ch4'] = round($data->ch4,2)." PPM";
            $akhir[$index]['temperature'] = round($data->temperature,2)." °C";
            $akhir[$index]['humidity'] = round($data->humidity,2)." %";
            $akhir[$index]['lat'] = $data->lat;
            $akhir[$index]['lng'] = $data->lng;
            $akhir[$index]['created_at'] = $data->created_at."'";
        }
        return DataTables::of($akhir)->toJson();
    }
}
