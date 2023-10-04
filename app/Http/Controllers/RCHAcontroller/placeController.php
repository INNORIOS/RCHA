<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class placeController extends Controller
{
    public function storePlace(Request $request)
    {
        $validator = Validator::make($request->All(), [
            'place_name' => 'required',
            'place_location' => 'required',
            'place_status' => 'required',
            'place_details' => 'required',
            'category_id'=> 'required',
            'place_preview_viedo' => 'required',
            'place_link' => 'required',
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
           //else create a place
           $place = Place::create($validator->validated());
        return response()->json(
            [
                'message' => 'Place is recorded successful!',
                'place' => $place
            ],
            201
        );
    }
    public function getPlaces()
{
    $places = Place::all();

    return response()->json($places, 200);
}
public function getPlaceById($place_id)
{
    $place = Place::findOrFail($place_id);

    return response()->json($place, 200);
}
public function updatePlace(Request $request, $place_id)
{
    $validator = Validator::make($request->all(), [
        'place_name' => 'required',
        'place_location' => 'required',
        'place_status' => 'required',
        'place_details' => 'required',
        'category_id'=> 'required',
        'place_preview_viedo' => 'required', // Corrected field name
        'place_link' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    $place = Place::findOrFail($place_id);
    $place->update($validator->validated());

    return response()->json([
        'message' => 'Place updated successfully!',
        'place' => $place
    ], 200);
}



}
