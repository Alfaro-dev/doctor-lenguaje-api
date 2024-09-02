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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules');
            $table->string('title');
            $table->integer('order');
            $table->text('description');
            $table->string('grammar_topic');
            $table->integer('experience_points');
            $table->text('objective');
            $table->json('vocabulary');
            $table->json('verbs');
            $table->json('native_expression');
            $table->json('content');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
