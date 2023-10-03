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
            'place_image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'place_image2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'place_image3' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'place_image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'place_image5' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'place_image6' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
           //else create a user
           $place = Place::create($validator->validated());
        return response()->json(
            [
                'message' => 'Place is recorded successful!',
                'place' => $place
            ],
            201
        );
    }

}
