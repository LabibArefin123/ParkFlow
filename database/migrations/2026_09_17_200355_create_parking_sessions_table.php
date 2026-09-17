<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parking_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_spot_id')->nullable()->index();
            $table->foreignId('vehicle_id')->nullable()->index();
            $table->dateTime('entry_time');
            $table->dateTime('exit_time')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled'])->nullable();
            $table->string('entry_gate')->nullable();
            $table->string('exit_gate')->nullable();
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->decimal('parking_fee', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_sessions');
    }
};
