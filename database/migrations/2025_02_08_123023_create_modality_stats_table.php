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
        Schema::create('modality_stats', function (Blueprint $table) {
            $table->id();
            $table->double('auditory_score',8,2)->default(0.00);
            $table->double('visual_score',8,2)->default(0.00);
            $table->double('kinesthetic_score',8,2)->default(0.00);
            $table->double('reading_and_writing_score',8,2)->default(0.00);
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modality_stats');
    }
};
