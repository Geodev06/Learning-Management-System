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
        Schema::create('param_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['P', 'A'])->default('A');
            $table->string('instructions', 5000);
            $table->enum('modality', ['K', 'V', 'R', 'A']);
            $table->dateTime('deadline');
            $table->dateTime('posted_date')->nullable(true);
            $table->enum('submission_type', ['G', 'I'])->default('I');
            $table->enum('posted_flag', ['Y', 'N'])->default('N');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_tasks');
    }
};
