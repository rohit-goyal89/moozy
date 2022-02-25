<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;
use App\Repositories\CuisineRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Cuisine;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Flash;
use Response;

class CuisineController extends AppBaseController
{
    /** @var  CuisineRepository */
    private $cuisineRepository;

    public function __construct(CuisineRepository $cuisineRepo)
    {
        $this->cuisineRepository = $cuisineRepo;
    }

    /**
     * Display a listing of the Cuisine.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $where = [];
        if(auth()->user()->role_id != 1) {
            $where['restaurant_owner_id'] = auth()->user()->id;
        }
        $cuisines = Cuisine::where($where)->paginate(config('app.limit'));

        return view('cuisines.index')
            ->with('cuisines', $cuisines);
    }

    /**
     * Show the form for creating a new Cuisine.
     *
     * @return Response
     */
    public function create()
    {
        $where['status'] = 1;
        return view('cuisines.create');
    }

    /**
     * Store a newly created Cuisine in storage.
     *
     * @param CreateCuisineRequest $request
     *
     * @return Response
     */
    public function store(CreateCuisineRequest $request)
    {
        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $input['restaurant_owner_id'] = auth()->user()->id;
        $cuisine = $this->cuisineRepository->create($input);

        Flash::success('Cuisine saved successfully.');

        return redirect(route('cuisines.index'));
    }

    /**
     * Display the specified Cuisine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        return view('cuisines.show')->with('cuisine', $cuisine);
    }

    /**
     * Show the form for editing the specified Cuisine.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        return view('cuisines.edit', compact('cuisine'));
    }

    /**
     * Update the specified Cuisine in storage.
     *
     * @param int $id
     * @param UpdateCuisineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCuisineRequest $request)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }
        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        if(auth()->user()->role_id != 1) {
            $input['restaurant_owner_id'] = auth()->user()->id;
        }
        $cuisine = $this->cuisineRepository->update($input, $id);

        Flash::success('Cuisine updated successfully.');

        return redirect(route('cuisines.index'));
    }

    /**
     * Remove the specified Cuisine from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        $this->cuisineRepository->delete($id);

        Flash::success('Cuisine deleted successfully.');

        return redirect(route('cuisines.index'));
    }
}
