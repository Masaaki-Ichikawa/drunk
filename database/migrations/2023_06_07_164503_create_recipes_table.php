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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name', 30)->nullable(false);
            $table->string('recipe', 300)->nullable(false);
            $table->string('image_path', 100);
            $table->foreignId('jenre_id')->constrained()->nullable(false);
            $table->foreignId('user_id')->constrained()->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
