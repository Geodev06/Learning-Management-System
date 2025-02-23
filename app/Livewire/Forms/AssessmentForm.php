<?php

namespace App\Livewire\Forms;

use App\Models\Assessment;
use App\Models\AssessmentDetail;
use App\Models\LessonQuestion;
use App\Models\LessonQuestionChoice;
use App\Models\Module;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AssessmentForm extends Component
{

    public $module_id, $lesson_id, $type;
    public $answers = [];  // To hold 

    public $has_questions_mc = false;
    public $has_questions_i = false;
    public $has_questions_e = false;
    public $has_questions_ho = false;

    public function mount($module_id, $lesson_id, $type)
    {
        $this->module_id = decrypt($module_id);
        $this->lesson_id = decrypt($lesson_id);
        $this->type = decrypt($type);
    }

    public function submit()
    {

        // Dynamically generate validation rules for each question
        $rules = [];

        switch ($this->type) {

            case 'MC':
                // Add validation rules for each dynamic question (Multiple choice)
                $multiple_choice = LessonQuestion::where([
                    'lesson_id' => $this->lesson_id,
                    'module_id' => $this->module_id
                ])->where('type', $this->type)->get();

                foreach ($multiple_choice as $item) {
                    $rules["answers.question_{$item->id}"] = 'required';
                }

                // Validate the answers array based on dynamically generated rules
                $this->validate($rules);

                try {
                    DB::beginTransaction();

                    $assessment = Assessment::create([
                        'module_id' => $this->module_id,
                        'lesson_id' => $this->lesson_id,
                        'type' => $this->type,
                        'created_by' => Auth::user()->id,
                        'no_of_items' => sizeof($multiple_choice)
                    ]);


                    $user_answer = array_values($this->answers);


                    if (sizeof($multiple_choice) > 0) {

                        $accumulated_points = 0;
                        $total_points = 0;

                        $grade = 0;

                        for ($i = 0; $i < sizeof($multiple_choice); $i++) {

                            $total_points += $multiple_choice[$i]->points;
                            $correct_flag = 'N';

                            if ($multiple_choice[$i]->correct == $user_answer[$i]) {

                                $correct_flag = 'Y';
                                $accumulated_points += $multiple_choice[$i]->points;
                            }

                            AssessmentDetail::create([
                                'assessment_id' => $assessment->id,
                                'correct_flag' => $correct_flag,
                                'points' => $multiple_choice[$i]->points,
                                'question' => $multiple_choice[$i]->question,
                                'correct_answer' => $multiple_choice[$i]->correct,
                                'user_answer' => $user_answer[$i]
                            ]);
                        }

                        $grade = (($accumulated_points / $total_points) * 100);

                        $mark = 'F';

                        if ($grade > 75) {
                            $mark = 'P';
                        }

                        Assessment::find($assessment->id)->update(
                            [
                                'points' => $accumulated_points,
                                'total_points' => $total_points,
                                'grade' => $grade,
                                'mark' => $mark
                            ]
                        );
                    }


                    $notification_data = [
                        'type' => 'notification',
                        'title' => 'Assessment Submitted Multiple Choice',
                        'icon' => 'fas fa-check',
                        'seen_flag' => 0,
                        'link' => 'sample link',
                        'message' => 'Assessment Submitted By ' . base64_decode(Auth::user()->first_name) . ' ' . base64_decode(Auth::user()->last_name),
                        'receiver_id' => Module::find($this->module_id)->created_by,
                        'created_by' => Auth::user()->id
                    ];

                    $this->notify_users($notification_data);


                    DB::commit();

                    $this->dispatch('success', [
                        'title' => 'Success',
                        'message' => $this->lang['assessment_submitted'],
                        'status' => 'success',

                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                }

                break;

            case 'I':
                // Add validation rules for each dynamic question (Multiple choice)
                $identification = LessonQuestion::where([
                    'lesson_id' => $this->lesson_id,
                    'module_id' => $this->module_id
                ])->where('type', $this->type)->get();

                foreach ($identification as $item) {
                    $rules["answers.question_{$item->id}"] = 'required';
                }

                // Validate the answers array based on dynamically generated rules
                $this->validate($rules);

                try {
                    DB::beginTransaction();

                    $assessment = Assessment::create([
                        'module_id' => $this->module_id,
                        'lesson_id' => $this->lesson_id,
                        'type' => $this->type,
                        'created_by' => Auth::user()->id,
                        'no_of_items' => sizeof($identification)
                    ]);


                    $user_answer = array_values($this->answers);


                    if (sizeof($identification) > 0) {

                        $accumulated_points = 0;
                        $total_points = 0;

                        $grade = 0;

                        for ($i = 0; $i < sizeof($identification); $i++) {

                            $total_points += $identification[$i]->points;
                            $correct_flag = 'N';

                            if (strtolower($identification[$i]->correct) == strtolower($user_answer[$i])) {

                                $correct_flag = 'Y';
                                $accumulated_points += $identification[$i]->points;
                            }

                            AssessmentDetail::create([
                                'assessment_id' => $assessment->id,
                                'correct_flag' => $correct_flag,
                                'points' => $identification[$i]->points,
                                'question' => $identification[$i]->question,
                                'correct_answer' => $identification[$i]->correct,
                                'user_answer' => $user_answer[$i]
                            ]);
                        }

                        $grade = (($accumulated_points / $total_points) * 100);

                        $mark = 'F';

                        if ($grade > 75) {
                            $mark = 'P';
                        }

                        Assessment::find($assessment->id)->update(
                            [
                                'points' => $accumulated_points,
                                'total_points' => $total_points,
                                'grade' => $grade,
                                'mark' => $mark
                            ]
                        );
                    }

                    $notification_data = [
                        'type' => 'notification',
                        'title' => 'Assessment Submitted Identification',
                        'icon' => 'fas fa-check',
                        'seen_flag' => 0,
                        'link' => 'sample link',
                        'message' => 'Assessment Submitted By ' . base64_decode(Auth::user()->first_name) . ' ' . base64_decode(Auth::user()->last_name),
                        'receiver_id' => Module::find($this->module_id)->created_by,
                        'created_by' => Auth::user()->id
                    ];

                    $this->notify_users($notification_data);

                    DB::commit();

                    $this->dispatch('success', [
                        'title' => 'Success',
                        'message' => $this->lang['assessment_submitted'],
                        'status' => 'success',

                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                }

                break;

            case 'E':
                // Add validation rules for each dynamic question (Multiple choice)
                $essay = LessonQuestion::where([
                    'lesson_id' => $this->lesson_id,
                    'module_id' => $this->module_id
                ])->where('type', $this->type)->get();

                foreach ($essay as $item) {
                    $rules["answers.question_{$item->id}"] = 'required';
                }

                // Validate the answers array based on dynamically generated rules
                $this->validate($rules);

                try {
                    DB::beginTransaction();

                    $assessment = Assessment::create([
                        'module_id' => $this->module_id,
                        'lesson_id' => $this->lesson_id,
                        'type' => $this->type,
                        'created_by' => Auth::user()->id,
                        'no_of_items' => sizeof($essay),
                        'checked_flag' => 'N',
                        'checker_id' => Module::find($this->module_id)->created_by

                    ]);


                    $user_answer = array_values($this->answers);


                    if (sizeof($essay) > 0) {

                        $accumulated_points = 0;
                        $total_points = 0;

                        $grade = 0;

                        for ($i = 0; $i < sizeof($essay); $i++) {

                            $total_points += $essay[$i]->points;
                            $correct_flag = 'Y';

                            AssessmentDetail::create([
                                'assessment_id' => $assessment->id,
                                'correct_flag' => $correct_flag,
                                'points' => $essay[$i]->points,
                                'question' => $essay[$i]->question,
                                'correct_answer' => NULL,
                                'user_answer' => $user_answer[$i]
                            ]);
                        }

                        $grade = (($accumulated_points / $total_points) * 100);

                        $mark = 'F';

                        if ($grade > 75) {
                            $mark = 'P';
                        }

                        Assessment::find($assessment->id)->update(
                            [
                                'points' => 0,
                                'total_points' => $total_points,
                                'grade' => $grade,
                                'mark' => $mark
                            ]
                        );
                    }

                    $notification_data = [
                        'type' => 'notification',
                        'title' => 'Assessment Submitted Essay',
                        'icon' => 'fas fa-check',
                        'seen_flag' => 0,
                        'link' => 'sample link',
                        'message' => 'Assessment Submitted By ' . base64_decode(Auth::user()->first_name) . ' ' . base64_decode(Auth::user()->last_name),
                        'receiver_id' => Module::find($this->module_id)->created_by,
                        'created_by' => Auth::user()->id
                    ];

                    $this->notify_users($notification_data);

                    DB::commit();

                    $this->dispatch('success', [
                        'title' => 'Success',
                        'message' => $this->lang['assessment_submitted'],
                        'status' => 'success',

                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                }

                break;

            case 'HO':
                // Add validation rules for each dynamic question (Multiple choice)
                $essay = LessonQuestion::where([
                    'lesson_id' => $this->lesson_id,
                    'module_id' => $this->module_id
                ])->where('type', $this->type)->get();

                foreach ($essay as $item) {
                    $rules["answers.question_{$item->id}"] = 'required';
                }

                // Validate the answers array based on dynamically generated rules
                $this->validate($rules);

                try {
                    DB::beginTransaction();

                    $assessment = Assessment::create([
                        'module_id' => $this->module_id,
                        'lesson_id' => $this->lesson_id,
                        'type' => $this->type,
                        'created_by' => Auth::user()->id,
                        'no_of_items' => sizeof($essay),
                        'checked_flag' => 'N',
                        'checker_id' => Module::find($this->module_id)->created_by

                    ]);


                    $user_answer = array_values($this->answers);


                    if (sizeof($essay) > 0) {

                        $accumulated_points = 0;
                        $total_points = 0;

                        $grade = 0;

                        for ($i = 0; $i < sizeof($essay); $i++) {

                            $total_points += $essay[$i]->points;
                            $correct_flag = 'Y';

                            AssessmentDetail::create([
                                'assessment_id' => $assessment->id,
                                'correct_flag' => $correct_flag,
                                'points' => $essay[$i]->points,
                                'question' => $essay[$i]->question,
                                'correct_answer' => NULL,
                                'user_answer' => $user_answer[$i]
                            ]);
                        }

                        $grade = (($accumulated_points / $total_points) * 100);

                        $mark = 'F';

                        if ($grade > 75) {
                            $mark = 'P';
                        }

                        Assessment::find($assessment->id)->update(
                            [
                                'points' => 0,
                                'total_points' => $total_points,
                                'grade' => $grade,
                                'mark' => $mark
                            ]
                        );
                    }

                    $notification_data = [
                        'type' => 'notification',
                        'title' => 'Assessment Submitted Hands On',
                        'icon' => 'fas fa-check',
                        'seen_flag' => 0,
                        'link' => 'sample link',
                        'message' => 'Assessment Submitted By ' . base64_decode(Auth::user()->first_name) . ' ' . base64_decode(Auth::user()->last_name),
                        'receiver_id' => Module::find($this->module_id)->created_by,
                        'created_by' => Auth::user()->id
                    ];

                    $this->notify_users($notification_data);

                    DB::commit();

                    $this->dispatch('success', [
                        'title' => 'Success',
                        'message' => $this->lang['assessment_submitted'],
                        'status' => 'success',

                    ]);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    Log::error($th->getMessage());
                }

                break;
        }
    }

    public function render()
    {

        $questions = [];

        $where = [
            'lesson_id' => $this->lesson_id,
            'module_id' => $this->module_id
        ];

        $multiple_choice = LessonQuestion::where(
            $where
        )->where('type', 'MC')->get();

        if (sizeof($multiple_choice) > 0) {
            foreach ($multiple_choice as $item) {
                $item->choices = LessonQuestionChoice::where('question_id', $item->id)->get();
            }
        }


        $identifications = LessonQuestion::where(
            $where
        )->where('type', 'I')->get();

        $essay = LessonQuestion::where(
            $where
        )->where('type', 'E')->get();

        $hands_on = LessonQuestion::where(
            $where
        )->where('type', 'HO')->get();



        if (sizeof($multiple_choice) > 0) {
            $this->has_questions_mc = TRUE;
        }

        if (sizeof($identifications) > 0) {
            $this->has_questions_i = TRUE;
        }

        if (sizeof($essay) > 0) {
            $this->has_questions_e = TRUE;
        }

        if (sizeof($hands_on) > 0) {
            $this->has_questions_ho = TRUE;
        }




        return view('livewire.forms.assessment-form', compact('multiple_choice', 'identifications', 'essay', 'hands_on'));
    }
}
