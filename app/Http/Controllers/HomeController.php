<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Page;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driverCount =  User::where(['role_id'=>3])->count();
        $customerCount =  User::where(['role_id'=>4])->count();
        $ownerCount =  User::where(['role_id'=>2])->count();
        $pageCount =  Page::count();
        return view('home',compact('pageCount', 'driverCount','customerCount','ownerCount'));
    }
}
