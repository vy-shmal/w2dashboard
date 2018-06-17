<?php

namespace W2dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use W2dashboard\Order;

class SyncController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $date = null)
    {

        $entityIds = array();

        if(empty($date)){

            $orders = DB::connection('superoffers')->table('sales_flat_order')->whereDate('created_at', DB::raw('CURDATE()'))->get();


        }else{
            $orders = DB::connection('superoffers')->table('sales_flat_order')->whereDate('created_at', $date)->get();
        }

          //var_dump( $orders )  ;

        //$orders = DB::connection('superoffers')->table('sales_flat_order')->whereDate('created_at', '2018-01-29')->get();


        foreach ($orders as $order) {
            Order::updateOrCreate(
                ['entity_id' => $order->entity_id] ,

                [
                    'increment_id' => $order->increment_id ,
                    'status' => $order->status,
                    'shipping_description' => $order->shipping_description,
                    'grand_total' => $order->grand_total,
                    'shipping_amount' => $order->shipping_amount,
                    'shipping_method' => $order->shipping_method,
                    'store_name' => $order->store_name,
                    'order_created_at' => $order->created_at,
                    'order_updated_at' => $order->updated_at,
                    'msp_cashondelivery_incl_tax' => $order->msp_cashondelivery_incl_tax
                ]
            );

            $entityIds[]= $order->entity_id ;
        }


        $payments = DB::connection('superoffers')->table('sales_flat_order_payment')->whereIn('entity_id', $entityIds )->get();

        foreach ( $payments as $payment){
            Order::where('entity_id', $payment->entity_id)
                ->update([
                    'method' => $payment->method,
                    'amount_ordered' => $payment->amount_ordered,
                    'amount_paid' => $payment->amount_paid
                ]) ;
        }

        //dd(Order::all());

//        foreach ($orders as $order) {
//
//            Order::
//        }
//        die();




        //return view('home')->with('orders',$orders);
        //return view('sync');
        return 'true' ;
    }
}
