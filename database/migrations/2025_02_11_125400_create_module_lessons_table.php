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
        Schema::create('module_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('lesson_no');
            $table->string('title', 255)->nullable()->default('Lesson Title.');
            $table->string('desc', 255)->nullable()->default('Lesson Description.');
            $table->enum('open_flag', ['Y','N'])->default('N');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_lessons');
    }
};
