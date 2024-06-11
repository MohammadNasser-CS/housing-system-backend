<?php

use App\Enum\CollegesEnum;
use App\Enum\SpecializationsEnum;
use App\Enum\UniversityBuildingsEnum;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->enum('college',array_values(CollegesEnum::MAP));
            $table->enum('specialization',array_values(SpecializationsEnum::MAP));
            $table->enum('universityBuilding',array_values(UniversityBuildingsEnum::MAP));
            $table->string('birthDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
