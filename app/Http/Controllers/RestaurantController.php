<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Repositories\RestaurantRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\RestaurantDetail;
use App\Models\RestaurantRating;
use App\Models\RestaurantManageTime;
use App\Models\Menu;
use App\Category;
use Flash;
use Response;

class RestaurantController extends AppBaseController
{
    /** @var  RestaurantRepository */
    private $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepo)
    {
        $this->restaurantRepository = $restaurantRepo;
    }

    /**
     * Display a listing of the Restaurant.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $restaurants = $this->restaurantRepository->all();

        return view('restaurants.index')
            ->with('restaurants', $restaurants);
    }

    /**
     * Show the form for creating a new Restaurant.
     *
     * @return Response
     */
    public function create()
    {
        $menus =  Menu::where('status',1)->pluck('title','id');
        $categories =  Category::where('status',1)->pluck('category','id');
        $selectedMenus = [];
        $selectedCat = [];
        return view('restaurants.create', compact('menus','selectedMenus', 'categories', 'selectedCat'));
    }

    /**
     * Store a newly created Restaurant in storage.
     *
     * @param CreateRestaurantRequest $request
     *
     * @return Response
     */
    public function store(CreateRestaurantRequest $request)
    {
        $input = $request->all();

        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $address= $input['address'].' . '.$input['city'].' . '.$input['town'].' . '.$input['postcode'];
        $address = str_replace(" ", "+", $address);

          $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCSq0HU1qQHerls8ZPwugwzfOqHYkFHodA&address='.urlencode($address).'&sensor=false');

        $json = json_decode($json);
         $restaurant = $this->restaurantRepository->create($input);
         //dd($input['menu']);
         if(!empty($request->menu)) {
             $restaurant->menus()->attach($input['menu']);
         }
        if(!empty($request->category)) {
             $restaurant->categories()->attach($input['category']);
         }
          if(!empty($request->manage_restaurant)) {
            $manageRestaurantModels = [];
            foreach ($request->manage_restaurant as $manageRestaurant) {
                $manageRestaurantModels[] = new RestaurantManageTime($manageRestaurant);
            }

            $restaurant->manageTime()->saveMany($manageRestaurantModels);
        }
        $gstPanNumber = $shopLicence = $photo = "";
        if($request->shop_licence) {
            $shopLicence = time().'.'.$request->shop_licence->extension();  

            $request->shop_licence->move(public_path('images'), $shopLicence);
        }
        
        if($request->gst_pan_number) {
            $gstPanNumber = time().'.'.$request->gst_pan_number->extension();  

            $request->gst_pan_number->move(public_path('images'), $gstPanNumber);
        }

        if($request->photo) {
            $photo = time().'.'.$request->photo->extension();  

            $request->photo->move(public_path('images'), $photo);
        }

        if(!empty($request->shop_licence) || !empty($request->gst_pan_number) || !empty($request->photo)) {
            $restInfo = new RestaurantDetail(['shop_licence' => $shopLicence,'gst_pan_number' => $gstPanNumber,'photo' => $photo]);
            $restaurant->restaurantDetail()->save($restInfo);
        }

        Flash::success('Restaurant saved successfully.');

        return redirect(route('restaurants.index'));
    }

    /**
     * Display the specified Restaurant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::with(['menus', 'restaurantDetail', 'manageTime','categories'])->find($id);

        if (empty($restaurant)) {
            Flash::error('Restaurant not found');

            return redirect(route('restaurants.index'));
        }

        return view('restaurants.show')->with('restaurant', $restaurant);
    }

    /**
     * Show the form for editing the specified Restaurant.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::with(['menus', 'restaurantDetail', 'manageTime','categories'])->find($id);

        if (empty($restaurant)) {
            Flash::error('Restaurant not found');

            return redirect(route('restaurants.index'));
        }
        $menus =  Menu::where('status',1)->pluck('title','id');
        $selectedMenus = $restaurant->menus()->allRelatedIds();
        $categories =  Category::where('status',1)->pluck('category','id');
        $selectedCat =  $restaurant->categories()->allRelatedIds();
        return view('restaurants.edit', compact('restaurant', 'menus', 'selectedMenus', 'categories','selectedCat'));
    }

    /**
     * Update the specified Restaurant in storage.
     *
     * @param int $id
     * @param UpdateRestaurantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRestaurantRequest $request)
    {
        $restaurant = $this->restaurantRepository->find($id);

        if (empty($restaurant)) {
            Flash::error('Restaurant not found');

            return redirect(route('restaurants.index'));
        }

        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $address= $input['address'].' . '.$input['city'].' . '.$input['town'].' . '.$input['postcode'];
        $address = str_replace(" ", "+", $address);

        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
        $json = json_decode($json);

        // $input['latitude'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        // $input['longitude'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        $restaurant = $this->restaurantRepository->update($input, $id);
        if(!empty($input['menu'])) {
             $restaurant->menus()->sync($input['menu']);
        }
       if(!empty($request->category)) {
             $restaurant->categories()->sync($input['category']);
         }
        $gstPanNumber = $shopLicence = $photo = "";
        if($request->shop_licence) {
            $shopLicence = time().'.'.$request->shop_licence->extension();  

            $request->shop_licence->move(public_path('images'), $shopLicence);
        }
        
        if($request->gst_pan_number) {
            $gstPanNumber = time().'.'.$request->gst_pan_number->extension();  

            $request->gst_pan_number->move(public_path('images'), $gstPanNumber);
        }

        if($request->photo) {
            $photo = time().'.'.$request->photo->extension();  

            $request->photo->move(public_path('images'), $photo);
        }

        if(!empty($request->shop_licence) || !empty($request->gst_pan_number) || !empty($request->photo)) {
            if ($restaurant->restaurantDetail === null)
            {
                $restInfo = new RestaurantDetail(['shop_licence' => $shopLicence,'gst_pan_number' => $gstPanNumber,'photo' => $photo]);
                $restaurant->restaurantDetail()->save($restInfo);
            }
            else
            {
                $restaurant->restaurantDetail()->update(['shop_licence' => $shopLicence,'gst_pan_number' => $gstPanNumber,'photo' => $photo]);
            }
            
        }
        if(!empty($request->manage_restaurant)) {
            //dd($request->manage_restaurant);
            $manageRestaurantModels = [];
            foreach ($request->manage_restaurant as $manageRestaurant) {
                $manageRestaurantModels[] = new RestaurantManageTime($manageRestaurant);
            }

            RestaurantManageTime::where('restaurant_id',$id)->delete();
            $restaurant->manageTime()->saveMany($manageRestaurantModels);
        }
        
        Flash::success('Restaurant updated successfully.');

        return redirect(route('restaurants.index'));
    }

    /**
     * Remove the specified Restaurant from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $restaurant = $this->restaurantRepository->find($id);
        
        if (empty($restaurant)) {
            Flash::error('Restaurant not found');

            return redirect(route('restaurants.index'));
        }

        $this->restaurantRepository->delete($id);

        Flash::success('Restaurant deleted successfully.');

        return redirect(route('restaurants.index'));
    }
}
