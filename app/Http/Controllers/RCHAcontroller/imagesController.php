<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class imagesController extends Controller
{
    public function createImage(Request $request)
    {
        $request->validate([
            'place_id' => 'required|exists:place,place_id',
            'image_path' => 'required|string', 
        ]);

        $image = Image::create($request->all());

        return response()->json([
            'message' => 'Image created successfully',
            'image' => $image
        ], 201);
    }

   
    
}
