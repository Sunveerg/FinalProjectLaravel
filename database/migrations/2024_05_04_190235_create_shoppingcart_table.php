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
        Schema::create('shoppingcart', function (Blueprint $table) {
            $table->primary(['user_name', 'item_name']);
            $table->integer('quantity')->default(1);
            $table->double('total');
            $table->timestamps();
            $table->integer('user_name')->unsigned();
            $table->integer('item_name')->unsigned();
            $table->foreign('user_name')->references('name')->on('users')->onDelete('cascade');
            $table->foreign('item_name')->references('name')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shoppingcart');
    }

    
};
