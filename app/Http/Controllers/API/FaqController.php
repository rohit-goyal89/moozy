<?php

namespace App\Http\Controllers\API;

use App\Models\Faq; 
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FaqController extends AppBaseController
{
    public $successStatus = 200;

    public function __construct()
    {

    }

    /**
     * Display a listing of the Faq.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request)
    {
        $pages = Faq::where('status',1)->get();

        $response['status'] = true;
        $response['data'] =  $pages; 
        $response['message'] = "List of faq";
        return response()->json($response, $this-> successStatus); 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    public function detail($id) 
    { 
        $faq = Faq::where('id',$id)->first(); 
        $response['status'] = true;
        $response['data'] =  $faq; 
        $response['message'] = "faq detail";
        return response()->json($response, $this-> successStatus); 
    } 
}
