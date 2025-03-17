<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image');
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->float('price')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('creator')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('editor')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });


        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
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
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_student');
    }
};
