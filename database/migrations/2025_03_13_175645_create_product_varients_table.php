<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVarientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_varients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->on('products')->onDelete('cascade');
            $table->foreignId('size_id');
            $table->foreignId('color_id');
            $table->double('cost_price')->default(0.0);
            $table->double('price')->default(0.0);
            $table->integer('stock')->default(0);
            $table->string('sku')->nullable();
            $table->integer('discount')->default(0);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('product_varients');
    }
}
