<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('product_variants', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->nullable();
                $table->foreignId('size_id')->default(0);
                $table->foreignId('color_id')->default(0);
                $table->decimal('cost_price')->default(0.00);
                $table->decimal('price')->default(0.00);
                $table->integer('stock')->default(0);
                $table->string('sku')->nullable();
                $table->integer('discount')->default(0);
                $table->string('image')->nullable();
                $table->tinyInteger('display_status')->default(0);
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
        Schema::dropIfExists('product_variants');
    }
}
