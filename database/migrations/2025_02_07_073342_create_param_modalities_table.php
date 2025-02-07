<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('param_modalities', function (Blueprint $table) {
            $table->id();
            $table->string('modality');
            $table->timestamps();
        });

        DB::unprepared("
            INSERT INTO param_modalities (`modality`) values ('Visual');
            INSERT INTO param_modalities (`modality`) values ('Auditory');
            INSERT INTO param_modalities (`modality`) values ('Kinesthetic');
            INSERT INTO param_modalities (`modality`) values ('Reading and Writing');
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_modalities');
    }
};
