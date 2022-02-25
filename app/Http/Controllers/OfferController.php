<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use App\Models\Offer;
use App\Models\Restaurant;
use App\Repositories\OfferRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OfferController extends AppBaseController
{
    /** @var  OfferRepository */
    private $offerRepository;

    public function __construct(OfferRepository $offerRepo)
    {
        $this->offerRepository = $offerRepo;
    }

    /**
     * Display a listing of the Offer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $offers = $this->offerRepository->all();

        return view('offers.index')
            ->with('offers', $offers);
    }

    /**
     * Show the form for creating a new Offer.
     *
     * @return Response
     */
    public function create()
    {
        $restaurants =  Restaurant::where('status',1)->pluck('name','id');
        //$restaurants->prepend("Select Restaurant",'');
        $selectedRest = [];
        return view('offers.create',compact('restaurants','selectedRest'));
    }

    /**
     * Store a newly created Offer in storage.
     *
     * @param CreateOfferRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferRequest $request)
    {
        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $imageName = "";
        if($request->offer_banner) {
            $imageName = time().'.'.$request->offer_banner->extension();  

            $request->offer_banner->move(public_path('images'), $imageName);
        }
        $input['offer_banner'] = $imageName;
        $offer = $this->offerRepository->create($input);

        $offer->restaurants()->attach($input['restaurant']);

        Flash::success('Offer saved successfully.');

        return redirect(route('offers.index'));
    }

    /**
     * Display the specified Offer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offer = Offer::with(['restaurants'])->find($id);

        if (empty($offer)) {
            Flash::error('Offer not found');

            return redirect(route('offers.index'));
        }

        return view('offers.show')->with('offer', $offer);
    }

    /**
     * Show the form for editing the specified Offer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offer = Offer::with(['restaurants'])->find($id);
        
        if (empty($offer)) {
            Flash::error('Offer not found');

            return redirect(route('offers.index'));
        }
        $restaurants =  Restaurant::where('status',1)->pluck('name','id');
        $selectedRest = $offer->restaurants()->allRelatedIds();
        //$restaurants = $restaurants->intersect($selectedRest);
        return view('offers.edit',compact('restaurants','offer','selectedRest'));
    }

    /**
     * Update the specified Offer in storage.
     *
     * @param int $id
     * @param UpdateOfferRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferRequest $request)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error('Offer not found');

            return redirect(route('offers.index'));
        }

        $input = $request->all();

        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
         $imageName = "";
        if($request->offer_banner) {
            $imageName = time().'.'.$request->offer_banner->extension();  

            $request->offer_banner->move(public_path('images'), $imageName);
             $input['offer_banner'] = $imageName;
        } else {
            unset($input['offer_banner']);
        }
       
        $offer = $this->offerRepository->update($input, $id);

        $offer->restaurants()->sync($input['restaurant']);
        
        Flash::success('Offer updated successfully.');

        return redirect(route('offers.index'));
    }

    /**
     * Remove the specified Offer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offer = $this->offerRepository->find($id);

        if (empty($offer)) {
            Flash::error('Offer not found');

            return redirect(route('offers.index'));
        }

        $this->offerRepository->delete($id);

        Flash::success('Offer deleted successfully.');

        return redirect(route('offers.index'));
    }
}
