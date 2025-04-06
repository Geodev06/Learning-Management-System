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
        Schema::create('param_awards', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('title');
            $table->text('description');

            $table->timestamps();
        });

        DB::unprepared("
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F3C6;', 'Top Learner Award', 'Recognizes the learner who has demonstrated exceptional progress or performance in a course.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F464;', 'Best Instructor Award', 'Given to an instructor who has shown excellence in teaching, providing feedback, and engaging students.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F465;', 'Most Engaged Learner', 'Awarded to the learner who is most active in participating in discussions, assignments, and activities.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F9D1;&#x200D;&#x1F4BB;', 'Highest Quiz Score', 'Recognizes the learner who scored the highest in a particular quiz or assessment.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F4C5;', 'Perfect Attendance Award', 'Given to learners who have attended every session or completed every module within the course.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F91D;', 'Peer Support Champion', 'Awarded to learners who have been consistently helpful to their peers through collaboration and support.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x2705;', 'Best Course Completion Rate', 'Recognizes the learner with the highest percentage of completed courses within a set period.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F947;', 'Outstanding Achievement Award', 'For learners who have shown exceptional results in a particular course or module.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F4AC;', 'Top Contributor', 'Awarded to a learner who contributes significantly to discussions, projects, or forums.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x2B50;', 'Lifetime Achievement Award', 'Recognizes long-term learners or instructors who have consistently excelled in multiple courses over time.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F4A1;', 'Innovation in Learning Award', 'Given to an instructor or learner who introduces innovative methods for enhancing the learning experience.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F4C6;', 'Certificate of Excellence', 'A certificate or digital badge for learners who complete a course with outstanding performance.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F46B;&#x200D;&#x1F4BB;', 'Best Group Project Award', 'Awarded to the team or group that performs the best in a collaborative project or assignment.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x23F3;', 'Fastest Learner', 'Recognizes the learner who completes a course or module in the shortest time while maintaining high-quality work.', now());
            INSERT INTO `lms`.`param_awards` (`icon`, `title`, `description`, `created_at`) VALUES ('&#x1F91D;', 'Leadership Recognition', 'Given to learners or instructors who demonstrate outstanding leadership in LMS communities or as course facilitators.', now());
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_awards');
    }
};
