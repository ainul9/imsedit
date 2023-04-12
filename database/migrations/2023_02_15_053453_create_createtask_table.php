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
        Schema::create('createtask', function (Blueprint $table) {
            $table->id();
            $table->foreign('agentID')->references('id')->on('agent');
            $table->string('productID')->unique();
            $table->string('ProductName');
            $table->string('agentID');
            $table->string('quantity');
            $table->string('pickupAdd'); 
            $table->dateTime('pickupDate'); 
            $table->string('deliveryAdd');
            $table->dateTime('deliveryDate');
            $table->string('remarks');
            $table->enum('status', ['','Successfully Delivered', 'Failed to Deliver', 'No Status']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('createtask');
    }
};
