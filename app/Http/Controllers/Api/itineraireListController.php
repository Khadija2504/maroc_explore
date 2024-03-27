<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Itineraire;
use App\Models\itineraireList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class itineraireListController extends Controller
{
    public function storeList(Request $request){
        $validator = Validator::make($request->all(), [
            'itineraire_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $user_id = auth()->id();
        $list = itineraireList::create([
            'itineraire_id' => $request->itineraire_id,
            'user_id' => $user_id,
        ]);
        return response()->json([
           'success' => true,
            'Added to list' => $list,
        ]);
    }
    public function displayList(){
        $user_id = auth()->user()->id;
        $lists = itineraireList::where('user_id', $user_id)->with('itineraires')->get();
        $listItineraires = [];

        foreach($lists as $list){
            $listItineraires[] = $list->itineraires->toArray();
        }
        return response()->json([
            'msg' => 'Display to visit list initeraires',
            'list' => $listItineraires,
        ]);
    }
}
