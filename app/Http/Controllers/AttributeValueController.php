<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Repositories\AttributeValueRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\AttributeValue;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Flash;
use Response;

class AttributeValueController extends AppBaseController
{
    /** @var  AttributeValueRepository */
    private $attributeValueRepository;

    public function __construct(AttributeValueRepository $attributeValueRepo)
    {
        $this->attributeValueRepository = $attributeValueRepo;
    }

    /**
     * Display a listing of the AttributeValue.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $attributeValues = AttributeValue::paginate(config('app.limit'));

        return view('attribute_values.index')
            ->with('attributeValues', $attributeValues);
    }

    /**
     * Show the form for creating a new AttributeValue.
     *
     * @return Response
     */
    public function create()
    {
        $attributes =  Attribute::where('status', 1)->pluck('name','id');
        $attributes =  $attributes->prepend("select attribute", '');
        return view('attribute_values.create', compact('attributes'));
    }

    /**
     * Store a newly created AttributeValue in storage.
     *
     * @param CreateAttributeValueRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeValueRequest $request)
    {
        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $attributeValue = $this->attributeValueRepository->create($input);

        Flash::success('Attribute Value saved successfully.');

        return redirect(route('attributeValues.index'));
    }

    /**
     * Display the specified AttributeValue.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        return view('attribute_values.show',compact('attributeValue'));
    }

    /**
     * Show the form for editing the specified AttributeValue.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }
        $attributes =  Attribute::where('status', 1)->pluck('name','id');
        $attributes =  $attributes->prepend("select attribute", '');
        return view('attribute_values.edit', compact('attributeValue', 'attributes'));
    }

    /**
     * Update the specified AttributeValue in storage.
     *
     * @param int $id
     * @param UpdateAttributeValueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributeValueRequest $request)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }
        if(!empty($request->status)) {
            $request->status = 1;
        } else {
            $request->status = 0;
        }
        $attributeValue = $this->attributeValueRepository->update($request->all(), $id);

        Flash::success('Attribute Value updated successfully.');

        return redirect(route('attributeValues.index'));
    }

    /**
     * Remove the specified AttributeValue from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        $this->attributeValueRepository->delete($id);

        Flash::success('Attribute Value deleted successfully.');

        return redirect(route('attributeValues.index'));
    }
}
