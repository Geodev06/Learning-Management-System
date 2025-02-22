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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('lesson_id');
            $table->double('points')->default(0.00);
            $table->double('total_points')->default(0.00);
            $table->integer('no_of_items');
            $table->double('grade', 8, 2)->default(0.00);
            $table->enum('mark', ['P', 'F'])->default('F');
            $table->enum('type', ['MC', 'I', 'E', 'HO']);
            $table->integer('created_by');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
