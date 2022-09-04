<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NodesReport;

class GPSTrackController extends Controller
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
    public function index($id)
    {
        return view('dash.nodes_gps_track', compact(
            'id'
        ));
    }
    public function gpsData(Request $request){
        try {
            if($request->start_date == $request->end_date){
                $nodes = NodesReport::where('node_id', $request->node_id)->whereDate('created_at', $request->start_date)->where('lat', '!=', 0)->where('lng', '!=', 0)->orderBy('created_at', 'ASC')->get(['lat','lng','created_at']);
            }else {
                $nodes = NodesReport::where('node_id', $request->node_id)->whereDate('created_at', '<=', $request->end_date)->whereDate('created_at', '>=', $request->start_date)->where('lat', '!=', 0)->where('lng', '!=', 0)->orderBy('created_at', 'ASC')->get(['lat','lng','created_at']);
            }
            if (count($nodes) == 0) {
                return redirect()->back()
                ->with('danger', 'Tracking GPS Node: '.$request->node_id.' Tidak tersedia pada tanggal tersebut!');
            }else {
                return redirect()->back()
                ->with('success', 'Tracking GPS Node: '.$request->node_id.' Tanggal: '.$request->start_date.' s/d '.$request->end_date)
                ->with('data', $nodes);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()
                ->with('danger', 'Error: '.$th->getMessage());
        }
    }
}
