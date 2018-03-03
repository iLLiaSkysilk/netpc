<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 */
    public function __construct()
    {
	    $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$contacts = DB::table('contacts')->orderBy('created_at', 'desc')->paginate(15);
        return view('home', compact('contacts'));
    }
}
