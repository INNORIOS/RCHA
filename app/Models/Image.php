<?php

namespace App\Models;

use App\Models\Place;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    
    // 'place_image1' ,
    // 'place_image2' ,
    // 'place_image3',
    // 'place_image4',
    // 'place_image5',
    // 'place_image6'
    protected $guarded = [];
    public function place()
{
    return $this->belongsTo(Place::class);
}

    
}
