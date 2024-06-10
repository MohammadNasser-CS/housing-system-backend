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
        Schema::create('primary_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('RoomId')->constrained('rooms')->onDelete('cascade');
            $table->integer('BedNumber');
            $table->integer('BedNumberBooked');
            $table->string('RoomSpace');
            $table->enum('Balcony', ['لا', 'نعم']);
            $table->enum('Desk', ['لا', 'نعم']);
            $table->enum('AC', ['لا', 'نعم']);
            $table->string('Price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primary_rooms');
    }
};
