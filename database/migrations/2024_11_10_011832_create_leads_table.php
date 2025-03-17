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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('creator')->nullable();
            $table->unsignedBigInteger('editor')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('leads');
    }
};
