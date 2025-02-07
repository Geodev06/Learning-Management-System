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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->text('overview',500);
            $table->text('bg_image',500)->nullable();
            $table->integer('no_of_lessons');
            $table->enum('post_flag',['Y','N'])->default('N');
            $table->enum('active_flag',['Y','N'])->default('Y');

            $table->integer('v_flag')->default(0);
            $table->integer('a_flag')->default(0);
            $table->integer('k_flag')->default(0);
            $table->integer('r_flag')->default(0);

            $table->integer('created_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
