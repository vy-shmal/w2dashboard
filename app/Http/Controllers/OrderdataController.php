<?php

namespace W2dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use W2dashboard\Order;
use W2dashboard\Http\Resources\Order as OrderResource;

class OrderdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date = null)
    {
        if(empty($date)){
            //Retrive todays orders
            $orders = Order::whereDate('order_created_at', DB::raw('CURDATE()'))->get();
        }else{
            $orders = Order::whereDate('order_created_at', $date)->get();
        }


        //return the data as json
        return OrderResource::collection($orders);
    }


        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
