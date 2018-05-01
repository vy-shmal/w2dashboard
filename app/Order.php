<?php

namespace W2dashboard;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity_id',
        'increment_id',
        'status',
        'shipping_description',
        'grand_total',
        'shipping_amount',
        'shipping_method',
        'store_name',
        'order_created_at',
        'order_updated_at',
        'msp_cashondelivery_incl_tax'
    ];
}
