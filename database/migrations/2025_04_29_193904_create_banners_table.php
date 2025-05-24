<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            
            $table->string('title')->nullable();                 // Optional title
            $table->string('subtitle')->nullable();              // Optional subtitle

            $table->string('image')->nullable();                 // Main image filename or path
            $table->string('image_url')->nullable();             // External image URL (optional)

            $table->string('button_text')->nullable();           // CTA button text
            $table->string('button_link')->nullable();           // CTA button link (URL or route)

            $table->integer('page')->default(0);                 // Page identifier for frontend
            $table->integer('precedence')->default(0);           // Display order among sliders

            $table->boolean('is_active')->default(true);         // Toggle visibility

            $table->timestamp('starts_at')->nullable();          // Start time for visibility
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
        Schema::dropIfExists('banners');
    }
}
