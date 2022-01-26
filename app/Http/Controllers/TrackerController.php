<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\Tracker;

class TrackerController extends Controller
{
    // public function save_info(Request $request) 
    // {
    //     $tracker = new Tracker();
    //     $tracker->id = $request->id;
    //     $tracker->ip = $request->ip;
    //     $tracker->os = $request->os;
    //     $tracker->device = $request->device;
    //     $tracker->browser = $request->browser;
    //     $tracker->geolocation = $request->geolocation;
    //     $tracker->save();
    //     return response()->json($tracker);
    // }

    public function save_info(Request $request)
    {
        $tracker  = Tracker::updateOrCreate([
            'ip'   => $request->ip,
        ],[
            'id'     => $request->get('id'),
            'os' => $request->get('os'),
            'device'    => $request->get("device"),
            'browser'   => $request->get('browser'),
            'geolocation'       => $request->get('geolocation')
        ]);
    }

    public function get_info(Request $request)
    {
        $tracker = Tracker::all();
        return response()->json([
            'tracker' => $tracker,
        ]);
    }

    // public function update_info(Request $request)
    // {
    //     $tracker  = Tracker::find($request->ip);
    //     $tracker->id = $request->id;
    //     $tracker->os = $request->os;
    //     $tracker->device = $request->device;
    //     $tracker->browser = $request->browser;
    //     $tracker->geolocation = $request->geolocation;

    //     $tracker->save();
        
    //     return response()->json($tracker);
    // }
}
