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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('vehicle_id')->constrained()->onDelete('restrict');
            $table->date('inspection_date');

            $table->boolean('steering');
            $table->string('steering_attachment')->nullable();

            $table->boolean('brakes');
            $table->string('brakes_attachment')->nullable();

            $table->boolean('lights');
            $table->string('lights_attachment')->nullable();

            $table->boolean('tires');
            $table->string('tires_attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};