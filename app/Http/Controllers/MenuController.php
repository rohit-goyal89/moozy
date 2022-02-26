<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Repositories\MenuRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Category;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\Attribute;
use Flash;
use Response;

class MenuController extends AppBaseController
{
    /** @var  MenuRepository */
    private $menuRepository;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepository = $menuRepo;
    }

    /**
     * Display a listing of the Menu.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $where=[];
         if(auth()->user()->role_id != 1) {
            $where['restaurant_owner_id'] = auth()->user()->id;
        }
        $menus = Menu::where($where)->paginate(config('app.limit'));

        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new Menu.
     *
     * @return Response
     */
    public function create()
    {
        $categories =  Category::where('status',1)->pluck('category','id');
        $selectedCat = [];
        $attributes = Attribute::with('attributeValues')->where('status',1)->get();
         
        return view('menus.create', compact('categories', 'selectedCat','attributes'));
    }

    /**
     * Store a newly created Menu in storage.
     *
     * @param CreateMenuRequest $request
     *
     * @return Response
     */
    public function store(CreateMenuRequest $request)
    {
        $input = $request->all();

        $input['restaurant_owner_id'] = auth()->user()->id;
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $imageName = "";
        if($request->photo) {
            $imageName = time().'.'.$request->photo->extension();  

            $request->photo->move(public_path('images'), $imageName);
        }
        $input['image'] = $imageName;
        $menu = $this->menuRepository->create($input);
         if(!empty($request->manage_menu)) {
            $manageMenuModels = [];
            foreach ($request->manage_menu as $manageMenu) {
                $manageMenuModels[] = new SubMenu($manageMenu);
            }
            $menu->submenus()->saveMany($manageMenuModels);
        }
        if(!empty($request->category)) {
            $menu->categories()->attach($input['category']);
        }
      if(!empty($request->customize_attr)) {
            $menu->attributes()->attach(array_keys($request->customize_attr));
         }
        Flash::success('Menu saved successfully.');

        return redirect(route('menus.index'));
    }

    /**
     * Display the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }

        return view('menus.show')->with('menu', $menu);
    }

    /**
     * Show the form for editing the specified Menu.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $menu = Menu::with(['submenus'])->find($id);
        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }
        $categories =  Category::where('status',1)->pluck('category','id');
        $selectedCat = $menu->categories()->allRelatedIds();
        $attributes = Attribute::with('attributeValues')->where('status',1)->get();
        return view('menus.edit', compact('menu', 'categories', 'selectedCat', 'attributes'));
    }

    /**
     * Update the specified Menu in storage.
     *
     * @param int $id
     * @param UpdateMenuRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMenuRequest $request)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }

        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $input['restaurant_owner_id'] = auth()->user()->id;
        $imageName = "";
        if($request->photo) {
            $imageName = time().'.'.$request->photo->extension();  

            $request->photo->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }else {
            unset($input['image']);
        }

        $menu = $this->menuRepository->update($input, $id);
         if(!empty($request->manage_menu)) {
           $manageMenuModels = [];
            foreach ($request->manage_menu as $manageMenu) {
                $manageMenuModels[] = new SubMenu($manageMenu);
            }
            
            Submenu::where('menu_id',$id)->delete();
            $menu->submenus()->saveMany($manageMenuModels);
        }
        if(!empty($request->customize_attr)) {
            $menu->attributes()->sync(array_keys($request->customize_attr));
         }
        
        Flash::success('Menu updated successfully.');

        return redirect(route('menus.index'));
    }

    /**
     * Remove the specified Menu from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $menu = $this->menuRepository->find($id);

        if (empty($menu)) {
            Flash::error('Menu not found');

            return redirect(route('menus.index'));
        }

        $this->menuRepository->delete($id);

        Flash::success('Menu deleted successfully.');

        return redirect(route('menus.index'));
    }

    public function deleteSubmenu(Request $request) {
        if($request->item_id) {
            Submenu::where('id',$request->item_id)->delete();;
            echo 1;
        } else {
            echo 0;
        }
        die;
    }
}
