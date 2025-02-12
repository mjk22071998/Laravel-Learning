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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body'); // The comment body
            $table->foreignId('user_id')->nullable()->default(null)->constrained()->onDelete('set null'); // Foreign key to User table
            $table->foreignId('post_id')->nullable()->constrained('posts')->onDelete('cascade'); // Foreign key to Post table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};