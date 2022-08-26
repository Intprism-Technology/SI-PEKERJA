<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alert;

class AlertsController extends Controller
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
        $alerts = Alert::all();
        return view('dash.alerts', compact(
            'alerts'
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
        $variable = "";
        if($request->co2){
            $variable .= "CO2, ";
        }
        if($request->co){
            $variable .= "CO, ";
        }
        if($request->ch4){
            $variable .= "CH4, ";
        }
        if($request->tmp_hum){
            $variable .= "Temperature, Humidity, ";
        }

        Alert::create([
            'type' =>$request->type,
            'variable' =>substr($variable,0,-2),
            'nodes' => 'Operator',
            'status' => 0,
        ]);

        return redirect()->back()->with('success', "Success Add Manual Alert !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Alert::where('id', $id)->update([
            'status' => 1
        ]);
        return redirect()->back()->with('success', "Success Set Manual Alert as Solved !");
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
        Alert::where('id', $id)->update([
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', "Success Set Manual Alert as Solved !");
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
