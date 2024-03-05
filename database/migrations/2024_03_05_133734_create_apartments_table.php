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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title', 80);
            $table->text('description');
            $table->integer('room_number');
            $table->integer('bed_number');
            $table->integer('toilet_number');
            $table->integer('square_meters');
            $table->text('img_url');
            $table->boolean('is_visible');
            $table->string('address');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 8, 6);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
