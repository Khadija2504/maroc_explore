<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destinations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class destinationsController extends Controller
{
    public function createDestination(Request $request){
        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'description' => 'required',
            'id_itineraire' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $destination = Destinations::create([
            'city_id' => $request->city_id,
            'description' => $request->description,
            'id_itineraire' => $request->id_itineraire,
        ]);
        return response()->json([
            'msg' => 'Destination created successfully',
            'destination' => $destination,
        ]);
    }
}