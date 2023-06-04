<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantImage extends Model
{
    use HasFactory;

    protected $imageFolderPath = '/storage/restaurants/';
    protected $fillable = ['restaurant_id','restaurant_image'];
    
    /**
     *  ACCESSOR TO GET FULL IMAGE PATH
    */
    public function getRestaurantImageAttribute($value) {
        if(!is_null($value) && !empty($value)) {
            return asset($this->imageFolderPath.$value);
        }
        return null;
    }
}
