<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entity_id','50');
            $table->string('increment_id','50')->collation('utf8_general_ci')->nullable();
            $table->string('status','32')->collation('utf8_general_ci')->nullable();
            $table->string('shipping_description','255')->collation('utf8_general_ci')->nullable();
            $table->decimal('grand_total',12,4	)->nullable();
            $table->decimal('shipping_amount',12,4	)->nullable();
            $table->string('shipping_method','255')->collation('utf8_general_ci')->nullable();
            $table->string('store_name','255')->collation('utf8_general_ci')->nullable();
            $table->timestamp('order_created_at')->nullable();
            $table->timestamp('order_updated_at')->nullable();
            $table->decimal('msp_cashondelivery_incl_tax',12,4	)->nullable();
            $table->string('method','255')->collation('utf8_general_ci')->nullable();
            $table->decimal('amount_ordered',12,4	)->nullable();
            $table->decimal('amount_paid',12,4	)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
