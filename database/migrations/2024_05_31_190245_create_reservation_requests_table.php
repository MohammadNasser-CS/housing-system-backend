<?php

use App\Enum\RequestStatusEnum;
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
        Schema::create('reservation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('houseOwnerId')->constrained('users')->onDelete('cascade');
            $table->foreignId('studentId')->constrained('users')->onDelete('cascade');
            $table->enum('requestStatus', array_values(RequestStatusEnum::MAP));
            $table->time('meetingTime');
            $table->date('meetingDay');
            $table->foreignId('roomId')->constrained('rooms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_requests');
    }
};
