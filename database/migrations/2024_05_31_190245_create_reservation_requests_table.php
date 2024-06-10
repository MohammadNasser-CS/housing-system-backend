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
        Schema::create('reservation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('HouseOwnerId')->constrained('users')->onDelete('cascade');
            $table->foreignId('StudentId')->constrained('users')->onDelete('cascade');
            $table->enum('RequestStatus', ['في الإنتظار', 'تم التأكيد', 'تم اللقاء']);
            $table->time('MeetingTime');
            $table->date('MeetingDay');
            $table->foreignId('RoomId')->constrained('rooms')->onDelete('cascade');
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
