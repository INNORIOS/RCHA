<?php

namespace App\Http\Controllers\RCHAcontroller;

use App\Models\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Support\Facades\Storage;

class imagesController extends Controller
{


public function createImage(Request $request)
{
    if(!$request->hasFile('file')) { // Changed to check for 'file' key
        return response()->json(['upload_file_not_found'], 400);
    }

    $file = $request->file('file'); 
    $imageName = time().'.'.$file->hashName();
    $image_path = public_path().'/images';
    $saveImage = $file->move($image_path, $imageName);

    if($saveImage) {
        $place_id = Place::findOrNew($request->place_id);
// dd($place_id->id);
        $save = new Image();
        $save->place_id = $place_id->id;
        $save->image_path = '/images/'.$imageName; // Adjusted to store the correct file path
        $save->save();

        return response()->json(['success' => true,'message'=>'Image is uploaded and saved in DB'], 200);
    }

    return response()->json(['Image not saved in DB'], 422);
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
