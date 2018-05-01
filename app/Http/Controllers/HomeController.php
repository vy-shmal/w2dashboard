<?php

namespace W2dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use W2dashboard\Order;


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
        //$orders = DB::connection('superoffers')->table('sales_flat_order')->whereDate('created_at', DB::raw('CURDATE()'))->get();
        //var_dump($order);

        $tzirosNoShipping = 0;
        $paymentMethods = array();

        //return view('home')->with('orders',$orders);
        $orders = Order::whereDate('order_created_at', '2018-01-29')->get();
        $totalOrders = $orders->count();

        //dd($orders);

        foreach ($orders as $order){
            $tzirosNoShipping += $order->grand_total - $order->shipping_amount;

           if(key_exists($order->method,$paymentMethods)){
               $paymentMethods[$order->method]['ammount'] +=  $order->amount_ordered;
               $paymentMethods[$order->method]['count'] +=  1;
           }else{
               $paymentMethods[$order->method] = array('ammount' => $order->amount_ordered, 'count' => 1);
           }

        }

        return view('home')
            ->with('totalOrders',$totalOrders)
            ->with('tzirosNoShipping',$tzirosNoShipping)
            ->with('paymentMethods',$paymentMethods);
    }
}
