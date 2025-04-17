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
            $table->unsignedBigInteger('designer_id');
            $table->foreignId('unit_id')->default(0);
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id')->nullable();
            $table->foreignId('brand_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('price');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('available_quantity');
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