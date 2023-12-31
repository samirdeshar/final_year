<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MapsData;

class FrontMapController extends Controller
{

    public function getData(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = 10; // Set your desired radius (in degrees)

        // Perform a query based on latitude and longitude within a certain radius
        $data = MapsData::whereBetween('latitude', [$latitude - $radius, $latitude + $radius])
            ->whereBetween('longitude', [$longitude - $radius, $longitude + $radius])
            ->get();

        return response()->json($data);
    }
        public function mapsdata()
        {
            // $data = MapsData::get()->all()
        }
}
