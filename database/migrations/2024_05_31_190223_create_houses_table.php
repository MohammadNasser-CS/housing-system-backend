<?php

use App\Enum\FlagEnum;
use App\Enum\HouseGenderEnum;
use App\Enum\HouseTypeEnum;
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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->text('description');
            $table->string('address');
            $table->enum('houseType', array_values(HouseTypeEnum::MAP));
            $table->enum('gender',array_values(HouseGenderEnum::MAP));
            $table->string('location');
            $table->enum('internet', array_values(FlagEnum::MAP));
            $table->enum('water', array_values(FlagEnum::MAP));
            $table->enum('electricity', array_values(FlagEnum::MAP));
            $table->enum('gas', array_values(FlagEnum::MAP));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
