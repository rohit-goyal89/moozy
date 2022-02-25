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
        $response[0]['title'] = 'Sort';
        $response[0]['isSelected'] = true;
        $response[0]['isOption'] = true;
        $response[0]['subFilter'] = config('app.sort');
        $response[1]['title'] = 'Cuisines';
        $response[1]['isSelected'] = false;
        $response[1]['isOption'] = false;
        $response[1]['subFilter'] = Cuisine::where('status',1)->get();
        // $response['status'] = true; 
        // $response['message'] = "sort type list";
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
        if(isset($input['page']) && $input['page'] > 1) {
             $offset = ($input['page'] - 1)*config('app.limit');
        } else {
            $offset = 0;
        }
        $userId = $input['user_id'] ?? 0;
        $restaurants = Restaurant::with(['restaurantDetail','ratings','favouriteRestaurants' => function($q) use ($userId)
            {
              $q->wherePivot('user_id','=', $userId);
            }])->selectRaw("id, name, address,restaurant_type,prepare_time,latitude, longitude,
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
                $hours = floor($restaurant['prepare_time']/60);
                $minutes = $restaurant['prepare_time']%60;
                $prepare_time = "";
                if($hours > 0) {
                    $prepare_time .= $hours.' hour ';
                }
                if($minutes > 0) {
                    $prepare_time .= $minutes.' minutes';
                }
                $restaurant["food_time"] = $prepare_time;
                $restaurant["avgRating"] = $restaurant->avgRating();
                 $restaurant["no_of_user_rated"] = count($restaurant['ratings']);
                if(($restaurant['favouriteRestaurants'])->isEmpty()) {
                    $restaurant["is_favourite"] = 0;
                } else {
                    $restaurant["is_favourite"] = 1;
                }

                $restaurant["food_type"] = config('app.restaurant_type')[$restaurant["restaurant_type"]];
              unset($restaurant['favouriteRestaurants']);
              unset($restaurant['ratings']);
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

        if(isset($input['page']) && $input['page'] > 1) {
            $offset = ($input['page'] - 1)*config('app.limit');
        } else {
            $offset = 0;
        }

        $category = $input['category'] ?? 0;
        $restaurant = $request->restaurant_id ?? 0;
        if($category) {
            $menus = Menu::with(['restaurants' => function($q) use ($restaurant)
            {
              $q->wherePivot('restaurant_id','=', $restaurant);
            },'submenus'])->whereHas('categories', function($q) use($category){ 
                                $q->where("category_id","=",$category); 
                            })->where('status', 1)
            ->orderBy("created_at",'desc')
            ->offset($offset)
            ->limit(config('app.limit'))
            ->get();
        } else {
             $menus = Menu::with(['restaurants','submenus'])->where('status',1);
            if(!empty($input['search'])) {
                $search = $input['search'];
                $menus = $menus->where('title', 'Like', "%$search%");
            }
            $menus = $menus->offset($offset)
            ->limit(config('app.limit'))
            ->get();
        }
        if(!empty($menus)) {
            foreach($menus as &$menu) {
                 $menu["restaurant_id"] = (count($menu['restaurants'])>0) ? $menu['restaurants'][0]['id']:0;
                 unset($menu['restaurants']);
            }

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
        if(isset($input['page']) && $input['page'] > 1) {
             $offset = ($input['page'] - 1)*config('app.limit');
        } else {
            $offset = 0;
        }
         $userId = $input['user_id'] ?? 0;
        $restaurants = Restaurant::with(['restaurantDetail','ratings','favouriteRestaurants' => function($q) use ($userId)
            {
              $q->wherePivot('user_id','=', $userId);
            }])->select("id", "name", "address", "restaurant_type", "prepare_time")
        ->where('status', '=', 1)
        ->orderBy("created_at",'desc')
        ->offset($offset)
        ->limit(config('app.limit'))
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                 $hours = floor($restaurant['prepare_time']/60);
                $minutes = $restaurant['prepare_time']%60;
                $prepare_time = "";
                if($hours > 0) {
                    $prepare_time .= $hours.' hour ';
                }
                if($minutes > 0) {
                    $prepare_time .= $minutes.' minutes';
                }
                $restaurant["food_time"] = $prepare_time;
                $restaurant["no_of_user_rated"] = count($restaurant['ratings']);
                $restaurant["food_type"] = config('app.restaurant_type')[$restaurant["restaurant_type"]];
                $restaurant["avgRating"] = $restaurant->avgRating();
                if(($restaurant['favouriteRestaurants'])->isEmpty()) {
                    $restaurant["is_favourite"] = 0;
                } else {
                    $restaurant["is_favourite"] = 1;
                }
              unset($restaurant['favouriteRestaurants']);
              unset($restaurant['ratings']);

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
        if(isset($input['page']) && $input['page'] > 1) {
             $offset = ($input['page'] - 1)*config('app.limit');
        } else {
            $offset = 0;
        }
        $userId = $input['user_id']??0;
        $restaurants = Restaurant::with(['restaurantDetail','ratings','favouriteRestaurants' => function($q) use ($userId)
            {
              $q->wherePivot('user_id','=', $userId);
            }])->select("id", "name", "address", "restaurant_type", "prepare_time")
        ->where('status', '=', 1)
        ->orderBy("created_at",'desc')
        ->offset($offset)
        ->limit(config('app.limit'))
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                $hours = floor($restaurant['prepare_time']/60);
                $minutes = $restaurant['prepare_time']%60;
                $prepare_time = "";
                if($hours > 0) {
                    $prepare_time .= $hours.' hour ';
                }
                if($minutes > 0) {
                    $prepare_time .= $minutes.' minutes';
                }
                $restaurant["food_time"] = $prepare_time;
                $restaurant["no_of_user_rated"] = count($restaurant['ratings']);
                $restaurant["food_type"] = config('app.restaurant_type')[$restaurant["restaurant_type"]];
                $restaurant["avgRating"] = $restaurant->avgRating();
                if(($restaurant['favouriteRestaurants'])->isEmpty()) {
                    $restaurant["is_favourite"] = 0;
                } else {
                    $restaurant["is_favourite"] = 1;
                }
                unset($restaurant['favouriteRestaurants']);
                unset($restaurant['ratings']);
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
        if(isset($input['page']) && $input['page'] > 1) {
             $offset = ($input['page'] - 1)*config('app.limit');
        } else {
            $offset = 0;
        }
        $userId = $input['user_id']??0;
        $restaurants = Restaurant::with(['restaurantDetail','ratings','favouriteRestaurants' => function($q) use ($userId)
            {
              $q->wherePivot('user_id','=', $userId);
            }])->select("id", "name", "address", "restaurant_type", "prepare_time");
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
                $hours = floor($restaurant['prepare_time']/60);
                $minutes = $restaurant['prepare_time']%60;
                $prepare_time = "";
                if($hours > 0) {
                    $prepare_time .= $hours.' hour ';
                }
                if($minutes > 0) {
                    $prepare_time .= $minutes.' minutes';
                }
                $restaurant["food_time"] = $prepare_time;
                $restaurant["no_of_user_rated"] = count($restaurant['ratings']);
                $restaurant["food_type"] = config('app.restaurant_type')[$restaurant["restaurant_type"]];
                $restaurant["avgRating"] = $restaurant->avgRating();
                if(($restaurant['favouriteRestaurants'])->isEmpty()) {
                    $restaurant["is_favourite"] = 0;
                } else {
                    $restaurant["is_favourite"] = 1;
                }
              unset($restaurant['favouriteRestaurants']);
              unset($restaurant['ratings']);
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
            'restaurant_id' => 'required',
            ''
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "please select restaurant.";
            return response()->json($response, 200);            
        }
        $input['status'] = 1;
        $user = User::where('id',$input['user_id'])->first();
        if($input['type'] == 1) {
            $user->favouriteRestaurants()->detach($input['restaurant_id']);
             $response['message'] = "Restaurant removed from your favourite list.";
        } else {
            $user->favouriteRestaurants()->attach($input['restaurant_id']);
            $response['message'] = "Restaurant Added in your favourite list.";
        } 
       
        $response['status'] = true;
        $response['data'] =  []; 
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
         if(isset($input['page']) && $input['page'] > 1) {
             $offset = ($input['page'] - 1)*config('app.limit');
        } else {
            $offset = 0;
        }
        $restaurants = Restaurant::with(['restaurantDetail','ratings'])
                        ->whereHas('favouriteRestaurants', function($q) use($input){ 
                            $q->where("user_restaurant.user_id","=",$input['user_id']); 
                        })->select("id", "name", "address", "restaurant_type", "prepare_time");
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
                $hours = floor($restaurant['prepare_time']/60);
                $minutes = $restaurant['prepare_time']%60;
                $prepare_time = "";
                if($hours > 0) {
                    $prepare_time .= $hours.' hour ';
                }
                if($minutes > 0) {
                    $prepare_time .= $minutes.' minutes';
                }
                $restaurant["food_time"] = $prepare_time;
                $restaurant["no_of_user_rated"] = count($restaurant['ratings']);
                $restaurant["food_type"] = config('app.restaurant_type')[$restaurant["restaurant_type"]];
                $restaurant["avgRating"] = $restaurant->avgRating();
                $restaurant["is_favourite"] = 1;

            }
        }

        $response['status'] = true;
        $response['data'] =  $restaurants; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);
    }


    public function view( Request $request)
    {
       $validator = Validator::make($request->all(), [ 
            'restaurant_id' => 'required',
            'day' => 'required'
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "please select restaurant and day.";
            return response()->json($response, 200);            
        }
        $day = $request->day;
        $userId = $request->user_id??0;
        $restaurants = Restaurant::with(['restaurantDetail','offers', 'manageTime'=> function($q) use ($day)
            {
              $q->where('day','=', $day);
            },'categories','ratings','favouriteRestaurants' => function($q) use ($userId)
            {
              $q->wherePivot('user_id','=', $userId);
            }])->select("id", "name", "address", "restaurant_type", "prepare_time");
        
        $restaurants = $restaurants->where('id', '=', $request->restaurant_id)
        ->orderBy("created_at",'desc')
        ->get();
        if(!empty($restaurants)) {
            foreach($restaurants as &$restaurant) {
                  $hours = floor($restaurant['prepare_time']/60);
                $minutes = $restaurant['prepare_time']%60;
                $prepare_time = "";
                if($hours > 0) {
                    $prepare_time .= $hours.' hour ';
                }
                if($minutes > 0) {
                    $prepare_time .= $minutes.' minutes';
                }
                $restaurant["food_time"] = $prepare_time;
                $restaurant["no_of_user_rated"] = count($restaurant['ratings']);
                $restaurant["food_type"] = config('app.restaurant_type')[$restaurant["restaurant_type"]];
                $restaurant["avgRating"] = $restaurant->avgRating();
                $restaurant["day"] = (count($restaurant['manageTime'])>0) ? $restaurant['manageTime'][0]['day'] : '';
                $restaurant["open_time"] = (count($restaurant['manageTime'])>0) ? $restaurant['manageTime'][0]['open_time'] : '';
                 $restaurant["close_time"] = (count($restaurant['manageTime'])>0) ? $restaurant['manageTime'][0]['close_time'] : '';
                if(($restaurant['favouriteRestaurants'])->isEmpty()) {
                    $restaurant["is_favourite"] = 0;
                } else {
                    $restaurant["is_favourite"] = 1;
                }
                 unset($restaurant['manageTime']);
                 unset($restaurant['favouriteRestaurants']);
            }
        }
       // $categories = Category::where('status',1)->get();
        $response['status'] = true;
        $response['data'] =  $restaurants[0]; 
        $response['message'] = "restaurants list";
        return response()->json($response, $this-> successStatus);
    }
    
    public function restaurantMenu( Request $request)
    {
       $validator = Validator::make($request->all(), [ 
            'restaurant_id' => 'required',
            'category_id' => 'required'
        ]);
        if ($validator->fails()) { 
            $response['status'] = false;
            $response['data'] =  ''; 
            $response['message'] = "please select restaurant and category.";
            return response()->json($response, 200);            
        }
    }
}