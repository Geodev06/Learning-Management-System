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
            $table->integer('first_login')->default(1);
            $table->enum('learning_modality',['A','V','K','R'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $password = "'".'$2y$10$wQzxSjKjv34R0aEnl0A9O.DunJaxP.8aWFJairWY.xm7sA7WLh5U.'."'";

        DB::unprepared("
                 INSERT INTO `lms`.`users` ( `first_name`, `middle_name`, `last_name`, `email`, `password`, `active_flag`, `gender`, `role`, `login_attempt`, `first_login`, `learning_modality`, `created_at`, `updated_at`) VALUES ( 'QWdlbw==', '', 'QWdub3Rl', 'lms.admin@yopmail.com', $password, 'Y', 'NS', 'ADMIN', '3', '0', 'V', '2025-02-11 16:14:33', '2025-02-11 16:15:10');
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
