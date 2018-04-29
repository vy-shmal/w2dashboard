<?php

namespace W2dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $orders = DB::connection('superoffers')->table('sales_flat_order')->whereDate('created_at', DB::raw('CURDATE()'))->get();
        //var_dump($order);

        return view('home')->with('orders',$orders);
    }
}
