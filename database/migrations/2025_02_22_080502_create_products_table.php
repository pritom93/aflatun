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
            $table->string('product_name');
            $table->integer('product_price');
            $table->text('product_description')->nullable();
            $table->string('product_image');
            $table->integer('product_available_quantity');
            $table->string('product_size')->nullable();
            $table->string('color')->nullable();
            $table->boolean('promoted_item')->default(false);
            $table->decimal('vat')->default(2.5);
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