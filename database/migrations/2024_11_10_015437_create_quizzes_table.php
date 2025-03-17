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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->timestamps();
        });

        Schema::create('quiz_question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->timestamps();

            $table->unique(['quiz_id', 'question_id']);

            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

            $table->foreign('creator')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreign('editor')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('quiz_question');
    }
};
