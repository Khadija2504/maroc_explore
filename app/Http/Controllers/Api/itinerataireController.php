<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Itineraire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class itinerataireController extends Controller
{
    public function itineraire(Request $request){
        // dd('hello World');
        $validator = Validator::make($request->all(),[
            'titre' => 'required',
            'description' => 'required',
            'point_depart' => 'required',
            'point_arrivee' => 'required',
            'date' => 'required',
            'duree' => 'required',
            'category_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user_id = auth()->id();

        $itineraire = Itineraire::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'point_depart' => $request->point_depart,
            'point_arrivee' => $request->point_arrivee,
            'date' => $request->date,
            'duree' => $request->duree,
            'category_id' => $request->category_id,
            'user_id' => $user_id,
        ]);
        return response()->json([
            'msg' => 'Itineraire created successfully',
            'itineraire' => $itineraire,
        ]);
    }
    public function diaplayItineraire(){
        $itineraire = Itineraire::all();
        return response()->json([
            'msg' => 'Les itineraires dans la plateforme',
            'itineraire' => $itineraire,
        ]);
    }
    public function updateItineraire(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'titre' =>'max:2000',
            'description' =>'min:1',
            'point_depart' =>'max:2000',
            'point_arrivee' =>'max:2000',
            'date' =>'max:2000',
            'duree' =>'max:2000',
            'category_id' =>'max:2000',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $itineraire = Itineraire::find($id);
        $itineraire->titre = $request->titre;
        $itineraire->description = $request->description;
        $itineraire->point_depart = $request->point_depart;
        $itineraire->point_arrivee = $request->point_arrivee;
        $itineraire->date = $request->date;
        $itineraire->duree = $request->duree;
        $itineraire->category_id = $request->category_id;
        $itineraire->update();
        return response()->json([
            'msg' => 'Itineraire updated successfully',
            'itineraire' => $itineraire,
        ]);
    }
    public function search(Request $request){
        $validator = Validator::make($request->all(),[
           'search' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $search = $request->search;
        $itineraire = Itineraire::where('titre', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->get();
        return response()->json([
            'msg' => 'your result about' . ' ' . $search,
            'itineraire' => $itineraire,
        ]);
    }
    public function filter(Request $request){
        $validator = Validator::make($request->all(),[
            'filterBy' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        if(is_numeric($request->filterBy) && $request->filterBy > 0){
            $itineraires = Itineraire::where('duree', $request->filterBy)->first();
            if(isset($itineraires->id)){
                $itineraire = Itineraire::where('duree', $request->filterBy)->get();
            } else{
                $itineraire = 'No results found';
            }
        } else{
            $categories = category::where('name', $request->filterBy)->first();
            if(isset($categories->id)){
                $category_id = $categories->id;
                $itineraires = Itineraire::where('category_id', $category_id)->first();
                if(isset($itineraires->id)){
                    $itineraire = Itineraire::where('category_id', $category_id)->get();
                } else{
                    $itineraire = 'No results found';
                }
            } else{
                $itineraire = 'No results found';
            }
        }

        return response()->json([
            'msg' => 'your result about' . ' ' . $request->filtreBy,
            'itineraire' => $itineraire,
        ]);
    }
}
