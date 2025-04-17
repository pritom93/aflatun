<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('payment_method')->comment('1=Cash on delivery, 2=Online payment, 3=Bank transfer, 4=Cheque');
            $table->tinyInteger('payment_status')->default(0);
            $table->double('shipping_charge')->default(0.00);
            $table->integer('discount')->default(0);
            $table->double('subtotal');
            $table->double('tax');
            $table->double('total', 8, 4);
            $table->tinyInteger('delivery_status')->default(0);
            $table->string('delivery_date')->nullable(); 
            $table->tinyInteger('order_status')->default(0);     
            $table->string('order_date');
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
