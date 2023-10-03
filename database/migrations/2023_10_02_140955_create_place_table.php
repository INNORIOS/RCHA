<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('place', function (Blueprint $table) {
            $table->bigIncrements('place_id');
            $table->unsignedBigInteger('category_id');
            $table->string('place_name');
            $table->string('place_location');
            $table->string('place_status');
            $table->string('place_details');
            $table->string('place_preview_viedo');
            $table->string('place_image1');
            $table->string('place_image2');
            $table->string('place_image3');
            $table->string('place_image4');
            $table->string('place_image5');
            $table->string('place_image6');
            $table->string('place_link');
            $table->foreign('category_id')->references('category_id')->on('category')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place');
    }
};
