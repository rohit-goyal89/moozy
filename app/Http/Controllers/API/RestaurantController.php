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
use App\User;
use App\Category;
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
     * Display a listing of the Cuisines.
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
        $response['sort'] = 'multi';
        $response['status'] = true;
        $response['data'] =  $cuisines; 
        $response['message'] = "cuisines list";
        return response()->json($response, $this-> successStatus);
    }

    /**
     * Display a listing of the sort.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function sortType(Request $request)
    {
        $response['sort'] = 'single';
        $response['status'] = true;
        $response['data'] =  config('app.sort'); 
        $response['message'] = "sort type list";
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

        $category = $input['category'] ?? 0;
        if($category) {

            $menus = Menu::whereHas('categories', function($q) use($category){ 
                                $q->where("category_id","=",$category); 
                            })->where('status', 1)
            ->orderBy("created_at",'desc')
            ->offset($offset)
            ->limit(config('app.limit'))
            ->get();
        } else {
             $menus = Menu::where('status',1);
            if(!empty($input['search'])) {
                $search = $input['search'];
                $menus = $menus->where('title', 'Like', "%$search%");
            }
            $menus = $menus->offset($offset)
            ->limit(config('app.limit'))
            ->get();
        }
       

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

    /**
     * Add to favourite Restaurant.
     *
     * @return Response
     */
    public function addToFavourite(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [ 
            'user_id' => 'required', 
            'restaurant_id' => 'required'
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "please select restaurant.";
            return response()->json($response, 200);            
        }
        $input['status'] = 1;
        $user = User::where('id',$input['user_id'])->first();
        $user->favouriteRestaurants()->attach($input['restaurant_id']);
        $userInfo = User::where('id',$input['user_id'])->with(['favouriteRestaurants'])->first();
        $response['status'] = true;
        $response['data'] =  $userInfo; 
        $response['message'] = "Restaurant Added in your favourite list.";
        return response()->json($response, $this-> successStatus);
    }

    /**
     * Delete from favourite Restaurant.
     *
     * @return Response
     */
    public function removeFavourite(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [ 
            'user_id' => 'required', 
            'restaurant_id' => 'required'
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "please select restaurant.";
            return response()->json($response, 200);            
        }
        $input['status'] = 1;
        $user = User::where('id',$input['user_id'])->first();
        $user->favouriteRestaurants()->detach($input['restaurant_id']);
        $userInfo = User::where('id',$input['user_id'])->with(['favouriteRestaurants'])->first();
        $response['status'] = true;
        $response['data'] =  $userInfo; 
        $response['message'] = "Restaurant Removed from your favourite list.";
        return response()->json($response, $this-> successStatus);
    }

     /**
     * Add rating and review Restaurant.
     *
     * @return Response
     */
    public function createReviewRating(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [ 
            'user_id' => 'required', 
            'restaurant_id' => 'required',
            'rating' => 'required',
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "please select restaurant.";
            return response()->json($response, 200);            
        }
        $input['comment'] = $input['review'] ?? '';
        $user = User::where('id',$input['user_id'])->first();
        $user->userRestaurantRating()->create($input);
        $userInfo = User::where('id',$input['user_id'])->with(['userRestaurantRating'])->first();
        $response['status'] = true;
        $response['data'] =  $userInfo; 
        $response['message'] = "You have rated and review Restaurant successfully.";
        return response()->json($response, $this-> successStatus);
    }


    /**
     * My Favourite Restaurant.
     *
     * @return Response
     */
    public function myFavouriteRestaurant(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [ 
            'user_id' => 'required'
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "please select user.";
            return response()->json($response, 200);            
        }
        $offset = $input['offset'] ?? 0;
        $restaurants = Restaurant::with(['restaurantDetail'])
                        ->whereHas('favouriteRestaurants', function($q) use($input){ 
                            $q->where("user_restaurant.user_id","=",$input['user_id']); 
                        })->select("id", "name", "address");
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
                $restaurant["is_favourite"] = 1;

            }
        }

        $response['status'] = true;
        $response['data'] =  $restaurants; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);
    }


    public function view($id, Request $request)
    {
        $restaurants = Restaurant::with(['restaurantDetail','offers'])->select("id", "name", "address");
        
        $restaurants = $restaurants->where('id', '=', $id)
        ->orderBy("created_at",'desc')
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                $restaurant["avgRating"] = $restaurant->avgRating();

            }
        }
        $categories = Category::where('status',1)->get();
        $response['status'] = true;
        $response['categories'] = $categories;
        $response['data'] =  $restaurants[0]; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);
    }
    
}
