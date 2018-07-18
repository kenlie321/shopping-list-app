<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;

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
        // $list = DB::table('shopping_lists')
        // ->where('shopping_lists.user_id','=',auth()->user()->id)
        // ->get();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        //echo "<pre>{{var_dump($user->lists)}}</pre>";
        //return view('home')->with('list',$list);
        return view('home')->with('list',$user->lists);
    }
}
