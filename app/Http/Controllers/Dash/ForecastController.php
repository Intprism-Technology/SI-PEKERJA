<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NodesReport;
use Phpml\Regression\LeastSquares;
use Carbon\Carbon;

class ForecastController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $parameter = $request->parameter;
        $duration = $request->duration;
        $id = $request->node_id;
        if($parameter == 'temperature'){
            $label = ' °C';
        }else if($parameter == 'humidity'){
            $label = ' %';
        }else{
            $label = ' PPM';
        }
        
        if($duration == 'daily'){
            $report = NodesReport::whereDate('created_at', Carbon::now()->subDays(1))->orderBy('created_at', 'ASC')->get([$parameter, 'created_at'])->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d H');
            });
        }else if($duration == 'weekly' OR $duration == 'monthly'){
            if($duration == 'weekly'){
                $subDays = 7;
            }else if($duration == 'monthly'){
                $subDays = 30;
            }
            $report = NodesReport::where('created_at', '>=' ,Carbon::now()->subDays($subDays))->orderBy('created_at', 'ASC')->get([$parameter, 'created_at'])->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });
        }
        $result = [];
        foreach($report as $key => $reportDuration){
            foreach($report[$key] as $resultDuration){
                try {
                    $result[$key] = $result[$key]+$resultDuration->$parameter;
                } catch (\Throwable $th) {
                    //throw $th;
                    $result[$key] = 0+$resultDuration->$parameter;
                }
            }
            $result[$key] = $result[$key]/count($report[$key]);
        }

        // Regresi Linier Sederhana
        $sampleFromDb = [];
        $target = [];
        $data = $result;
        $count = 0;
        $latestKey;
        foreach($data as $key=>$d){
            $sampleFromDb[$count] = $d;
            $target[$count] = array($count);
            $latestKey = $key;
            $count++;
        }
        try {
            $regression = new LeastSquares();
            $regression->train($target, $sampleFromDb);
            if($duration == 'daily'){
                return redirect()->back()
                ->with('success', 'Forecast '.$parameter.' '.$duration)
                ->with('latestIndex', $latestKey)
                ->with('latestCount', $count)
                ->with('duration', 'daily')
                ->with('label', $label)
                ->with('regression', $regression);
            }else if($duration == 'weekly' OR $duration == 'monthly'){
                return redirect()->back()
                ->with('success', 'Forecast '.$parameter.' '.$duration)
                ->with('latestIndex', $latestKey)
                ->with('latestCount', $count)
                ->with('duration', $duration)
                ->with('label', $label)
                ->with('regression', $regression);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('danger', 'Insufficient sample to forecast '.$parameter.' '.$duration);
        }
        // return $regression->predict([23]);
        // return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sample_co2 = [];
        $label_co2 = [];
        $data = NodesReport::where('node_id', $id)->get();
        $i = 1;
        foreach($data as $d){
            $sample_co2[$i] = $d->co2;
            $label_co2[$i] = array($i);
            $i++;
        }
        $samples = $label_co2;
        $targets = $sample_co2;

        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        return view('dash.nodes_sensors_forecast', compact(
            'id',
            'regression'
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
}
