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
        Schema::create('photo_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('post_id');
            $table->timestamps();
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_post');
    }
};
