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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receiving_user_id');
            $table->unsignedBigInteger('sending_user_id');
            $table->unsignedBigInteger('receiving_item_id');
            $table->unsignedBigInteger('sending_item_id');
            $table->foreign('receiving_user_id')->references('id')->on('users');
            $table->foreign('sending_user_id')->references('id')->on('users');
            $table->foreign('receiving_item_id')->references('id')->on('items');
            $table->foreign('sending_item_id')->references('id')->on('items');
            $table->integer('receiving_quantity');
            $table->integer('sending_quantity');
            $table->enum('accepted', ['pending', 'accepted', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
