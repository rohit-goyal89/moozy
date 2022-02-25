<?php

namespace App\Http\Controllers\API;

use App\Page; 
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PageController extends AppBaseController
{
    public $successStatus = 200;

    public function __construct()
    {

    }

    /**
     * Display a listing of the Page.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request)
    {
        $pages = Page::where('status',1)->get();

        $response['status'] = true;
        $response['data'] =  $pages; 
        $response['message'] = "List of pages";
        return response()->json($response, $this-> successStatus); 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function detail(Request $request) 
    { 
        $input = $request->all();
        $page = Page::where('slug',$input['slug'])->first(); 
        $response['status'] = true;
        $response['data'] =  $page; 
        $response['message'] = "page detail";
        return response()->json($response, $this-> successStatus); 
    } 
}
