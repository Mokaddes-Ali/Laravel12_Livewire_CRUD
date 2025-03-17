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
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('curriculum_id')->default(0);
            $table->unsignedBigInteger('exam_id')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->string('link');
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->timestamps();

            $table->foreign('curriculum_id')->references('id')->on('curriculums')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('homework');
    }
};
