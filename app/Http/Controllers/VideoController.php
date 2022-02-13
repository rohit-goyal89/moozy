<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Video;
use Flash;
use Response;
use Validator;

class VideoController extends AppBaseController
{

    public function __construct()
    {
       
    }

    /**
     * Display a listing of the Video.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $videos = Video::all();

        return view('videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new Video.
     *
     * @return Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created Video in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
         
        $validated = $request->validate([ 
           'url' => 'required_without:file',
            'file' => 'required_without:url',
            'discount_type' => 'required',
            'amount' => 'required',
            'min_price' => 'required'
        ]);
        $input = $request->all();

        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $imageName = "";
        if($request->file) {
            $imageName = time().'.'.$request->file->extension();  

            $request->file->move(public_path('images'), $imageName);
        }
        $input['file'] = $imageName;
        $video = Video::create($input);

        Flash::success('Video saved successfully.');

        return redirect(route('videos.index'));
    }

    /**
     * Display the specified Video.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $video = Video::find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }

        return view('videos.show')->with('video', $video);
    }

    /**
     * Show the form for editing the specified Video.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $video = Video::find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }

        return view('videos.edit')->with('video', $video);
    }

    /**
     * Update the specified Video in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
       $validated = $request->validate([  
           'url' => 'required_without:file',
            'file' => 'required_without:url',
            'discount_type' => 'required',
            'amount' => 'required',
            'min_price' => 'required'
        ]);
        $video = Video::find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }
        $input = $request->all();
        if(!empty($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $imageName = "";
        if($request->file) {
            $imageName = time().'.'.$request->file->extension();  

            $request->file->move(public_path('images'), $imageName);
            $input['file'] = $imageName;
        }else {
            unset($input['file']);
        }
        unset($input['_method']);
        unset($input['_token']);
        $video = Video::where('id', $id)->update($input);

        Flash::success('Video updated successfully.');

        return redirect(route('videos.index'));
    }

    /**
     * Remove the specified Video from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }

        Video::delete($id);

        Flash::success('Video deleted successfully.');

        return redirect(route('videos.index'));
    }
}
