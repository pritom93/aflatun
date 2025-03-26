<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id');
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id')->nullable();
            $table->string('product_name');
            $table->integer('product_price');
            $table->text('product_description')->nullable();
            $table->string('product_image');
            $table->integer('product_available_quantity');
            $table->boolean('promoted_item')->default(false);
            $table->boolean('has_varient')->default(false);
            $table->double('vat')->default(2.5);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}