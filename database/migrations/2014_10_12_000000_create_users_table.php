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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no', 255) ->nullable();
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('active_flag', ['Y', 'N'])->default('Y');
            $table->enum('gender', ['M', 'F', 'NS'])->default('NS');
            $table->enum('role', ['ADMIN', 'TEACHER', 'STUDENT'])->default('STUDENT');
            $table->text('profile')->nullable();
            $table->string('org_code', 255)->nullable();
            $table->integer('login_attempt')->default(3);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
