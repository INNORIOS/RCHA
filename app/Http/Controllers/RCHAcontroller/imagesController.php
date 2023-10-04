<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class imagesController extends Controller
{
    public function createImage(Request $request)
    {
        // $upload_image = if ($request->file('image')->isValid()) {
        //     $path = $request->file('image')->store('images'); 
        //     $url = Storage::url($path);}
        $upload_image =$request->store('public/image-uploads/');
        $request->validate([
            'place_id' => 'required|exists:place,place_id',
            'image_path' => 'required|string', 
        ]);

        $image = Image::create($request->all());
        if ($image)
        {
            return response()->json([
            'message' => 'Image created successfully',
            'image' => $image
        ], 201);
    }else{
        return response()->json([
            'message' => 'Image is not saved!'], 201); 
    }
    }
    public function updateImage(Request $request, $image_id)
    {
        $request->validate([
            'place_id' => 'required|exists:place,place_id',
            'image_path' => 'required|string',
        ]);

        $image = Image::findOrFail($image_id);
        $image->update($request->all());

        return response()->json([
            'message' => 'Image updated successfully',
            'image' => $image
        ], 200);
    }
    public function deleteImage($image_id)
    {
        $image = Image::findOrFail($image_id);
        $image->delete();

        return response()->json([
            'message' => 'Image deleted successfully',
        ], 200);
    }
   
   
    
}
