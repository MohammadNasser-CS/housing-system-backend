<?php

use App\Enum\FlagEnum;
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
            $table->foreignId('roomId')->constrained('rooms')->onDelete('cascade');
            $table->integer('bedNumber');
            $table->integer('bedNumberBooked');
            $table->string('roomSpace');
            $table->enum('balcony', array_values(FlagEnum::MAP));
            $table->enum('desk', array_values(FlagEnum::MAP));
            $table->enum('ac', array_values(FlagEnum::MAP));
            $table->string('price');
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
