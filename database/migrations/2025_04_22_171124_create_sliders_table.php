<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();              // Optional title
            $table->string('subtitle')->nullable();           // Optional subtitle
            $table->string('image')->nullable();                     // Main image path or URL
            $table->string('image_url')->nullable();                      // Main image path or URL
            $table->string('button_text')->nullable();        // Optional CTA button text
            $table->string('button_link')->nullable();        // Optional CTA link
            $table->integer('page')->default(0);          // For ordering sliders
            $table->integer('precedence')->default(0);          // For ordering sliders
            $table->boolean('is_active')->default(true);      // Active/inactive toggle
            $table->timestamp('starts_at')->nullable();       // Start showing at
            $table->timestamp('ends_at')->nullable();  
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
        Schema::dropIfExists('sliders');
    }
}
