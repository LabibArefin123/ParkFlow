<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parking_location_id')->nullable()->index();
            $table->string('floor')->nullable();
            $table->string('spot_number');
            $table->enum('vehicle_type', ['car', 'motorcycle', 'microbus', 'cng'])->nullable();
            $table->enum('status', ['available', 'occupied', 'reserved', 'maintenance'])->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parking_spots');
    }
};
