<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RestaurantImage;
use App\Models\RestaurantMenu;
use App\Helpers\CommonHelper;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','restaurant_name','restaurant_description'];

    public function images() {
        return $this->hasMany(RestaurantImage::class,'restaurant_id');
    }

    public function menus() {
        return $this->hasMany(RestaurantMenu::class,'restaurant_id');
    }
}
