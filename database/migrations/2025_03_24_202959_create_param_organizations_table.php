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
        Schema::create('param_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('org_code');
            $table->string('name');
            $table->timestamps();
        });

        DB::unprepared("
            INSERT INTO `lms`.`param_organizations` (`org_code`, `name`, `created_at`) VALUES ('BS_IT', 'BS Information Technology', now());
            INSERT INTO `lms`.`param_organizations` (`org_code`, `name`, `created_at`) VALUES ('BS_CS', 'BS_Computer Science', now());
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_organizations');
    }
};
