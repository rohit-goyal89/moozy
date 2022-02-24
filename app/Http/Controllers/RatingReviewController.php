<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Repositories\SupportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RestaurantRating;
use App\Models\UserRating;
use Flash;
use Response;

class RatingReviewController extends AppBaseController
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the Support.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function userRating(Request $request)
    {
        $rating = UserRating::with(['users', 'drivers'])->paginate(config('app.limit'));

        return view('rating_reviews.user_rating', compact('rating'));
    }

    /**
     * Show the form for creating a new Support.
     *
     * @return Response
     */
    public function restaurantRating()
    {
         $rating = RestaurantRating::with(['users', 'restaurants'])->paginate(config('app.limit'));
         return view('rating_reviews.restaurant_rating', compact('rating'));
    }

    /**
     * Store a newly created Support in storage.
     *
     * @param CreateSupportRequest $request
     *
     * @return Response
     */
    public function store(CreateSupportRequest $request)
    {
        $input = $request->all();

        $support = $this->supportRepository->create($input);

        Flash::success('Support saved successfully.');

        return redirect(route('supports.index'));
    }

    /**
     * Display the specified Support.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            Flash::error('Support not found');

            return redirect(route('supports.index'));
        }

        return view('supports.show')->with('support', $support);
    }

    /**
     * Show the form for editing the specified Support.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            Flash::error('Support not found');

            return redirect(route('supports.index'));
        }

        return view('supports.edit')->with('support', $support);
    }

    /**
     * Update the specified Support in storage.
     *
     * @param int $id
     * @param UpdateSupportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupportRequest $request)
    {
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            Flash::error('Support not found');

            return redirect(route('supports.index'));
        }

        $support = $this->supportRepository->update($request->all(), $id);

        Flash::success('Support updated successfully.');

        return redirect(route('supports.index'));
    }

    /**
     * Remove the specified Support from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $support = $this->supportRepository->find($id);

        if (empty($support)) {
            Flash::error('Support not found');

            return redirect(route('supports.index'));
        }

        $this->supportRepository->delete($id);

        Flash::success('Support deleted successfully.');

        return redirect(route('supports.index'));
    }
}
