<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Repositories\RestaurantRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantDetail;
use App\Models\Menu;
use App\Models\Cuisine;
use DB;
use Validator;
use Response;

class RestaurantController extends AppBaseController
{
  
    public $successStatus = 200;

    public function __construct()
    {
       
    }

    /**
     * Display a listing of the Restaurant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function cuisine(Request $request)
    {
        $cuisines = Cuisine::where('status',1);
        if(!empty($input['search'])) {
            $cuisines = $cuisines->where('name', 'Like', '%$input["search"]%');
        }
        $cuisines = $cuisines->get();
        $response['status'] = true;
        $response['data'] =  $cuisines; 
        $response['message'] = "cuisines list";
        return response()->json($response, $this-> successStatus);
    }

    /**
     * Nearest Restaurant.
     *
     * @return Response
     */
    public function nearestRestaurant(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [ 
            'latitude' => 'required', 
            'longitude' => 'required'
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "lat and long require to find nearest restaurant";
            return response()->json($response, 200);            
        }
        $offset = $input['offset'] ?? 0;
       $restaurants = Restaurant::with(['restaurantDetail'])->selectRaw("id, name, address, latitude, longitude,
                     ( 6371000 * acos( cos( radians(?) ) *
                       cos( radians( latitude ) )
                       * cos( radians( longitude ) - radians(?)
                       ) + sin( radians(?) ) *
                       sin( radians( latitude ) ) )
                     ) AS distance", [$input['latitude'], $input['longitude'], $input['latitude']])
        ->where('status', '=', 1)
        ->having("distance", "<=", config('app.radius'))
        ->orderBy("distance",'asc')
        ->offset($offset)
        ->limit(config('app.limit'))
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                $restaurant["avgRating"] = $restaurant->avgRating();

            }
        }
        $response['status'] = true;
        $response['data'] =  $restaurants; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);

    }

    /**
     * Top Pick Food.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function topMenu(Request $request)
    {
        $input = $request->all();

        $offset = $input['offset'] ?? 0;

        $menus = Menu::where('status',1);
        if(!empty($input['search'])) {
            $search = $input['search'];
            $menus = $menus->where('title', 'Like', "%$search%");
        }
        $menus = $menus->offset($offset)
        ->limit(config('app.limit'))
        ->get();

        $response['status'] = true;
        $response['data'] =  $menus; 
        $response['message'] = "menus list";
        return response()->json($response, $this-> successStatus);
    }

    /**
     * popular Restaurants.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function popularRestaurant(Request $request)
    {
        $input = $request->all();
        $offset = $input['offset'] ?? 0;
        $restaurants = Restaurant::with(['restaurantDetail'])->select("id", "name", "address")
        ->where('status', '=', 1)
        ->orderBy("created_at",'desc')
        ->offset($offset)
        ->limit(config('app.limit'))
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                $restaurant["avgRating"] = $restaurant->avgRating();

            }
        }
        $response['status'] = true;
        $response['data'] =  $restaurants; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);
    }

    /**
     * Frequently Order Restaurants.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function frequentlyOrderRestaurant(Request $request)
    {
        $input = $request->all();
        $offset = $input['offset'] ?? 0;
        $restaurants = Restaurant::with(['restaurantDetail'])->select("id", "name", "address")
        ->where('status', '=', 1)
        ->orderBy("created_at",'desc')
        ->offset($offset)
        ->limit(config('app.limit'))
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                $restaurant["avgRating"] = $restaurant->avgRating();

            }
        }
        $response['status'] = true;
        $response['data'] =  $restaurants; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);
    }

    /**
     * Search Restaurants.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function restaurantList(Request $request)
    {
        $input = $request->all();
        $offset = $input['offset'] ?? 0;
        $restaurants = Restaurant::with(['restaurantDetail'])->select("id", "name", "address");
        if(!empty($input['search'])) {
            $search =$input['search'];
            $restaurants = $restaurants->where('name', 'Like', "%$search%");
        }
        $restaurants = $restaurants->where('status', '=', 1)
        ->orderBy("created_at",'desc')
        ->offset($offset)
        ->limit(config('app.limit'))
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                $restaurant["avgRating"] = $restaurant->avgRating();

            }
        }
        $response['status'] = true;
        $response['data'] =  $restaurants; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);
    }
    
}
