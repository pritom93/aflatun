<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttrvaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attrvalues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attrname_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('count')->default(0);
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
        Schema::dropIfExists('attrvalues');
    }
}