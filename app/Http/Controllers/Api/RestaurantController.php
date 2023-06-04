<?php

namespace App\Http\Controllers\Api;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiMethodsTrait;
use Exception;
use App\Traits\ApiResponser;
use App\Models\RestaurantImage;
use Illuminate\Support\Facades\Storage;
use App\Models\RestaurantMenu;

class RestaurantController extends Controller
{
    use ApiMethodsTrait,ApiResponser;

    public function restaurant_listing(Request $request) {
        
        try {
            
            /*get all business users with restaurants*/
            $users = User::where(['user_type' => 'business','is_verified' => '1','is_suspended' => '0'])
                          ->with(['restaurant.images','restaurant.menus'])->get();
            
            if($users) {
                $restaurants = $users->pluck('restaurant')->toArray();

                $restaurants = array_map(function($record){

                    $images = collect($record['images'])->pluck('restaurant_image')->toArray();
                    $record['images'] = $images;
                    return $record;

                },$restaurants);
                
                return $this->returnSuccessResponse('Restaurant listing',$restaurants);
            }

            return $this->returnSuccessResponse('No Restaurant Found!',[]);
            
        }
        catch (Exception $exception) {
            report($exception);
            return $this->returnErrorResponse($exception->getMessage());
        }
    }

    public function restaurant_get(Request $request) {

        $rules = [
            'restaurant_id' => 'required|integer'
        ];
        $this->validate($request,$rules);

        try {
            
            $restaurant = Restaurant::where('id',$request->get('restaurant_id'))->first();
            if($restaurant) {
                $images = $restaurant->images;
                if($images->count() > 0) {
                    $images = $images->pluck('restaurant_image');
                }
                $menus   = $restaurant->menus;
                $dataArr = $restaurant->toArray();
                $dataArr['images'] = $images;
                $dataArr['menus'] = $menus;

                return $this->returnSuccessResponse('Restaurant Detail',$dataArr);
            }
            return $this->returnErrorResponse('Restaurant does not found.');
        }
        catch (Exception $exception) {
            report($exception);
            return $this->returnErrorResponse($exception->getMessage());
        }
    }

    public function restaurant_post(Request $request)
    {
        $this->validate($request,[

            'restaurant_name'        => 'required|string|min:2|max:500',
            'restaurant_description' => 'required|string|min:2|max:50000',
            'restaurant_images'      => 'required|array|min:1|max:10',
            'restaurant_images.*'    => 'mimes:jpeg,png,jpg,gif,svg','max:4096',
            'menu_images'            => 'required|array|min:1|max:10',
            'menu_images.*'          => 'mimes:jpeg,png,jpg,gif,svg','max:4096',
        ]);

       try {

           $user = auth()->user();
           $data = $request->all();
           $restaurant = $user->restaurant;

           if ($restaurant === null)
           {
                /*create restaurant*/
                $restaurant = new Restaurant([
                    
                    'user_id'                 => auth()->user()->id,
                    'restaurant_name'         => $data['restaurant_name'],
                    'restaurant_description'  => $data['restaurant_description'] ?? '',

                ]);

                $restaurant = $restaurant->save();
            }
            else
            {   /*update restaurant*/
                $restaurant->restaurant_name = $data['restaurant_name'];
                $restaurant->restaurant_description = $data['restaurant_description'];
                $restaurant->save();
            }
            /*restaurant images*/
            if($request->has('restaurant_images')) {
                
                if($restaurant->images->count() > 0){
                
                    $restaurant->images->each(function($record){     
                        /*check file exist*/
                        $arr = explode('/',$record->restaurant_image);
                        $filename = end($arr);
                        $file_path = 'restaurants/'.$filename;
                        Storage::disk(config('constants.image_path.driver'))->delete($file_path);
                        $record->delete();
                    });
                }

                foreach($request->file('restaurant_images') as $restaurant_image) {
                    
                    $path = CommonHelper::uploadImage('restaurants/',$restaurant_image);
                    $newrestaurantImage = new RestaurantImage([
                        'restaurant_id'    => $restaurant->id,
                        'restaurant_image' => $path
                    ]);
                    $newrestaurantImage->save();
                    
                }
            }
            /*restaurant menu*/
            if($request->has('restaurant_menus')) { 
                
                $menus = $request->get('restaurant_menus');

                $restaurant->menus->each(function($record){     
                    /*check file exist*/
                    $arr = explode('/',$record->restaurant_menu_image);
                    $filename = end($arr);
                    $file_path = 'restaurants/menus/'.$filename;
                    Storage::disk(config('constants.image_path.driver'))->delete($file_path);
                    $record->delete();
                });

                if(!empty($menus) && !is_null($menus)) {

                    $menu_images = $request->has('menu_images') ? $request->file('menu_images') : null;

                    foreach($menus as $menu_key => $menu) {
                        
                        $restaurant_menu_image_path = null;
                        if(!is_null($menu_images) && !empty($menu_images)) {

                            if(isset($menu_images[$menu_key])){

                                $restaurant_menu_image_path = CommonHelper::uploadImage('restaurants/menus/',$menu_images[$menu_key]);
                            }
                        }

                        $newrestaurantMenu = new RestaurantMenu([
                                        'restaurant_id'               => $restaurant->id,
                                        'restaurant_menu_name'        => $menu['name'],
                                        'restaurant_menu_price'       => $menu['price'],
                                        'restaurant_menu_quantity'    => $menu['quantity'],
                                        'restaurant_menu_description' => $menu['description'],
                                        'restaurant_menu_image'       => $restaurant_menu_image_path
                        ]);

                        $newrestaurantMenu->save();
                    }

                }
            }

            return $this->returnSuccessResponse('Restaurant saved successfully.');
           
        } catch (Exception $exception) {
            report($exception);
            return $this->returnErrorResponse($exception->getMessage());
            // return $this->respondInternalError($exception->getMessage());
        }
    }
}
