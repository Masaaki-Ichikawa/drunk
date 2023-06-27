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
            $table->string('recipe', 500)->nullable(false);
            $table->string('image_path', 100);
            $table->foreignId('jenre_id')->nullable(false)->constrained();
            // $table->foreignId('tag_id')->nullable(false)->constrained();
            $table->foreignId('user_id')->nullable(false)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('comments');
        Schema::dropIfExists('recipes');
    }
};
