<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Repositories\SupportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SupportController extends AppBaseController
{
    /** @var  SupportRepository */
    private $supportRepository;

    public function __construct(SupportRepository $supportRepo)
    {
        $this->supportRepository = $supportRepo;
    }

    /**
     * Display a listing of the Support.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $supports = $this->supportRepository->all();

        return view('supports.index')
            ->with('supports', $supports);
    }

    /**
     * Show the form for creating a new Support.
     *
     * @return Response
     */
    public function create()
    {
        return view('supports.create');
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
