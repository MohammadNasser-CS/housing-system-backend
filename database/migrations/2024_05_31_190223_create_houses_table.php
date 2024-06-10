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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserId')->constrained('users')->onDelete('cascade');
            $table->text('Description');
            $table->string('Address');
            $table->enum('HouseType', ['شقة', 'أستوديو']);
            $table->enum('Gender', ['أنثى', 'ذكر']);
            $table->string('Location');
            $table->enum('Internet', ['لا', 'نعم']);
            $table->enum('Water', ['لا', 'نعم']);
            $table->enum('Electricity', ['لا', 'نعم']);
            $table->enum('Gaz', ['لا', 'نعم']);
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
