<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
use App\Models\AssessmentDetail;
use App\Models\LessonQuestion;
use App\Models\Module;
use App\Models\ModuleLesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CheckAssessmentForm extends Component
{

    public $assessment_id, $type;
    public $lesson_id, $module_id;

    public $answers = [];  // To hold 

    public function mount($assessment_id)
    {
        $this->assessment_id = decrypt($assessment_id);
        $this->type = Assessment::find($this->assessment_id)->type;
    }

    public function submit()
    {
        $question_Details = AssessmentDetail::where([
            'assessment_id' => $this->assessment_id
        ])->get();

        $rules = [];
        $messages = [];

        foreach ($question_Details as $item) {
            $rules["answers.question_{$item->id}"] = 'required|max:' . $item->points . '|integer';
        }

        // Validate the answers array based on dynamically generated rules
        $this->validate($rules);

        try {
            DB::beginTransaction();

            $assessment = Assessment::find($this->assessment_id);

            $user_answer = array_values($this->answers);


            if (sizeof($question_Details) > 0) {

                $points = array_sum($user_answer);

                for ($i = 0; $i < sizeof($question_Details); $i++) {
                    
                    AssessmentDetail::find($question_Details[$i]->id)
                        ->update([
                            'points' => $user_answer[$i]
                        ]);
                }

                $grade = (($points / $assessment->total_points) * 100);

                $mark = 'F';

                if ($grade > 75) {

                    $mark = 'P';
                }

                $assessment->points = $points;
                $assessment->grade = $grade;
                $assessment->mark = $mark;
                $assessment->checked_flag = 'Y';
                $assessment->save();

            }




            $notification_data = [

                'type' => 'notification',
                'title' => 'Assessment Checked',
                'icon' => 'fas fa-check',
                'seen_flag' => 0,
                'link' => route('view_assessment_result', [
                    'assessment_id' => encrypt($assessment->id),
                ]),
                'message' => 'Assessment Checked By ' . base64_decode(Auth::user()->first_name) . ' ' . base64_decode(Auth::user()->last_name),
                'receiver_id' => Assessment::find($this->assessment_id)->created_by,
                'created_by' => Auth::user()->id
            ];

            $this->notify_users($notification_data);

            DB::commit();

            $this->dispatch('success', [
                'title' => 'Success',
                'message' => $this->lang['assessment_updated'],
                'status' => 'success',

            ]);
            
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }

    public function render()
    {

        $assessment = Assessment::find($this->assessment_id);
        $user = User::find($assessment->created_by);
        $assessment->creator = base64_decode($user->first_name) . ' ' . base64_decode($user->last_name);
        $assessment->module_name = Module::find($assessment->module_id)->title;
        $assessment->lesson_no = ModuleLesson::find($assessment->lesson_id)->lesson_no;

        $assessment_details = AssessmentDetail::where('assessment_id', $assessment->id)->get();

        return view('livewire.components.check-assessment-form', compact('assessment', 'assessment_details'));
    }
}
