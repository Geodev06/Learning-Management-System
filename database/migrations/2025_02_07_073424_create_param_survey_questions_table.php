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
        Schema::create('param_survey_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');

            $table->string('question_c1_label');
            $table->string('question_c1_val');

            $table->string('question_c2_label');
            $table->string('question_c2_val');

            $table->string('question_c3_label');
            $table->string('question_c3_val');

            $table->string('question_c4_label');
            $table->string('question_c4_val');



            $table->timestamps();
        });

        DB::unprepared("
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I need to find the way to a shop that a friend has recommended. I would:', 'find out where the shop is in relation to somewhere I know.', 'K', 'ask my friend to tell me the directions.', 'A', 'write down the street directions I need to remember.', 'R', 'use a map.', 'V');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('A website has a video showing how to make a special graph or chart. There is a person speaking, some lists and words describing what to do and some diagrams. I would learn most from', 'seeing the diagrams.', 'V', 'listening', 'A', 'reading the words.', 'R', 'watching the actions.', 'K');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to find out more about a tour that I am going on. I would:', 'look at details about the highlights and activities on the tour.', 'K', 'use a map and see where the places are.', 'V', 'read about the tour on the itinerary.', 'R', 'talk with the person who planned the tour or others who are going on the tour.', 'A');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('When choosing a career or area of study, these are important for me:', 'Applying my knowledge in real situations.', 'K', 'Communicating with others through discussion.', 'A', 'Working with designs, maps or charts', 'V', 'Using words well in written communications', 'R');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('When I am learning I:', 'like to talk things through.', 'A', 'see patterns in things.', 'V', 'use examples and applications.', 'K', 'read books, articles and handouts. ', 'R');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to save more money and to decide between a range of options. I would:', 'consider examples of each option using my financial information.', 'K', 'read a print brochure that describes the options in detail.', 'R', 'use graphs showing different options for different time periods.', 'V', '. talk with an expert about the options. ', 'A');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to learn how to play a new board game or card game. I would:', 'watch others play the game before joining in.', 'K', 'listen to somebody explaining it and ask questions.', 'A', 'use the diagrams that explain the various stages, moves and strategies in the game.', 'V', 'read the instructions.', 'R');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I have a problem with my heart. I would prefer that the doctor:', 'gave me something to read to explain what was wrong.', 'R', 'used a plastic model to show me what was wrong.', 'K', 'described what was wrong.', 'A', 'showed me a diagram of what was wrong. ', 'V');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to learn to do something new on a computer. I would:', 'read the written instructions that came with the program.', 'R', 'talk with people who know about the program.', 'A', 'start using it and learn by trial and error.', 'K', 'follow the diagrams in a book.', 'V');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('When learning from the Internet I like:', 'videos showing how to do or make things.', 'K', 'interesting design and visual features.', 'V', 'interesting written descriptions, lists and explanations.', 'R', 'audio channels where I can listen to podcasts or interviews. ', 'A');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to learn about a new project. I would ask for:', 'diagrams to show the project stages with charts of benefits and costs.', 'V', 'a written report describing the main features of the project.', 'R', 'an opportunity to discuss the project.', 'A', 'examples where the project has been used successfully.', 'K');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to learn how to take better photos. I would:', 'ask questions and talk about the camera and its features', 'A', 'use the written instructions about what to do.', 'R', 'use diagrams showing the camera and what each part does', 'V', 'use examples of good and poor photos showing how to improve them. ', 'K');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I prefer a presenter or a teacher who uses:', 'demonstrations, models or practical sessions.', 'K', 'question and answer, talk, group discussion, or guest speakers.', 'A', 'handouts, books, or readings.', 'R', 'diagrams, charts, maps or graphs. ', 'V');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I have finished a competition or test and I would like some feedback. I would like to have feedback:', 'using examples from what I have done', 'K', 'using a written description of my results.', 'R', 'from somebody who talks it through with me.', 'A', 'using graphs showing what I achieved. ', 'V');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to find out about a house or an apartment. Before visiting it I would want:', 'to view a video of the property.', 'K', 'a discussion with the owner.', 'A', '. a printed description of the rooms and features.', 'R', 'a plan showing the rooms and a map of the area. ', 'V');
            INSERT INTO `lms`.`param_survey_questions` (`question`, `question_c1_label`, `question_c1_val`, `question_c2_label`, `question_c2_val`, `question_c3_label`, `question_c3_val`, `question_c4_label`, `question_c4_val`) VALUES ('I want to assemble a wooden table that came in parts (kitset). I would learn best from:', 'diagrams showing each stage of the assembly.', 'V', 'advice from someone who has done it before', 'A', 'written instructions that came with the parts for the table.', 'R', 'watching a video of a person assembling a similar table. ', 'K');
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_survey_questions');
    }
};
