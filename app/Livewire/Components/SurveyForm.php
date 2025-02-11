<?php

namespace App\Livewire\Components;

use App\Models\ModalityStat;
use App\Models\ParamSurveyQuestion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SurveyForm extends Component
{

    public $question_1_K, $question_1_V, $question_1_A, $question_1_R;
    public $question_2_K, $question_2_V, $question_2_A, $question_2_R;
    public $question_3_K, $question_3_V, $question_3_A, $question_3_R;
    public $question_4_K, $question_4_V, $question_4_A, $question_4_R;
    public $question_5_K, $question_5_V, $question_5_A, $question_5_R;
    public $question_6_K, $question_6_V, $question_6_A, $question_6_R;
    public $question_7_K, $question_7_V, $question_7_A, $question_7_R;
    public $question_8_K, $question_8_V, $question_8_A, $question_8_R;
    public $question_9_K, $question_9_V, $question_9_A, $question_9_R;
    public $question_10_K, $question_10_V, $question_10_A, $question_10_R;
    public $question_11_K, $question_11_V, $question_11_A, $question_11_R;
    public $question_12_K, $question_12_V, $question_12_A, $question_12_R;
    public $question_13_K, $question_13_V, $question_13_A, $question_13_R;
    public $question_14_K, $question_14_V, $question_14_A, $question_14_R;
    public $question_15_K, $question_15_V, $question_15_A, $question_15_R;
    public $question_16_K, $question_16_V, $question_16_A, $question_16_R;


    public function submit()
    {
        

        if ($this->question_1_K == NULL and $this->question_1_V == NULL and $this->question_1_A == NULL and $this->question_1_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 1.');
            return;
        }
        if ($this->question_2_K == NULL and $this->question_2_V == NULL and $this->question_2_A == NULL and $this->question_2_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 2.');
            return;
        }
        if ($this->question_3_K == NULL and $this->question_3_V == NULL and $this->question_3_A == NULL and $this->question_3_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 3.');
            return;
        }
        if ($this->question_4_K == NULL and $this->question_4_V == NULL and $this->question_4_A == NULL and $this->question_4_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 4.');
            return;
        }
        if ($this->question_5_K == NULL and $this->question_5_V == NULL and $this->question_5_A == NULL and $this->question_5_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 5.');
            return;
        }
        if ($this->question_6_K == NULL and $this->question_6_V == NULL and $this->question_6_A == NULL and $this->question_6_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 6.');
            return;
        }
        if ($this->question_7_K == NULL and $this->question_7_V == NULL and $this->question_7_A == NULL and $this->question_7_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 7.');
            return;
        }
        if ($this->question_8_K == NULL and $this->question_8_V == NULL and $this->question_8_A == NULL and $this->question_8_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 8.');
            return;
        }
        if ($this->question_9_K == NULL and $this->question_9_V == NULL and $this->question_9_A == NULL and $this->question_9_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 9.');
            return;
        }
        if ($this->question_10_K == NULL and $this->question_10_V == NULL and $this->question_10_A == NULL and $this->question_10_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 10.');
            return;
        }
        if ($this->question_11_K == NULL and $this->question_11_V == NULL and $this->question_11_A == NULL and $this->question_11_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 11.');
            return;
        }
        if ($this->question_12_K == NULL and $this->question_12_V == NULL and $this->question_12_A == NULL and $this->question_12_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 12.');
            return;
        }
        if ($this->question_13_K == NULL and $this->question_13_V == NULL and $this->question_13_A == NULL and $this->question_13_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 13.');
            return;
        }
        if ($this->question_14_K == NULL and $this->question_14_V == NULL and $this->question_14_A == NULL and $this->question_14_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 14.');
            return;
        }
        if ($this->question_15_K == NULL and $this->question_15_V == NULL and $this->question_15_A == NULL and $this->question_15_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 15.');
            return;
        }
        if ($this->question_16_K == NULL and $this->question_16_V == NULL and $this->question_16_A == NULL and $this->question_16_R == NULL) {
            session()->flash('error', 'Please select atleast 1 answer for question no. 15.');
            return;
        }
        
        $answers = $this->get_survey_answer();
        
        try {
           DB::beginTransaction();

           if(ModalityStat::where('created_by',Auth::user()->id)->first()) 
           {
                $this->dispatch('msg_alert', 
                [
                    'title' => 'Error',
                    'message' => $this->lang['already_have_survey'],
                    'status' => 'error'
                ]);

                return;
           }

           $modality = new ModalityStat();
           $modality->auditory_score = $answers['A'];
           $modality->visual_score   = $answers['V'];
           $modality->kinesthetic_score = $answers['K'];
           $modality->reading_and_writing_score = $answers['R'];
           $modality->created_by = Auth::user()->id;
           $modality->save();

           $maxScore = max($answers); // Find the maximum percentage
           $maxKey = array_search($maxScore, $answers); // Find the key associated with the maximum score
       
           User::where('id', Auth::user()->id)->update(['first_login' => 0,'learning_modality' => $maxKey]);

           $this->dispatch('msg_alert', 
           [
               'title' => 'Success',
               'message' => $this->lang['survey_ok'],
               'status' => 'success'
           ]);

           DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }

    }



    public function render()
    {
        $questions = ParamSurveyQuestion::orderBy('id', 'asc')->get();
        return view('livewire.components.survey-form', compact('questions'));
    }
}
