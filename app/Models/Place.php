<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'place_name',
        'place_location',
        'place_status',
        'place_details',
        'category_id',
        'place_preview_viedo',
        'place_image1',
        'place_image2',
        'place_image3',
        'place_image4',
        'place_image5',
        'place_image6',
        'place_link',
    ];
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
