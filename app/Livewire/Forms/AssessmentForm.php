<?php

namespace App\Livewire\Forms;

use App\Models\LessonQuestion;
use App\Models\LessonQuestionChoice;
use Livewire\Component;

class AssessmentForm extends Component
{

    public $module_id, $lesson_id;

    public function mount($module_id, $lesson_id)
    {
        $this->module_id = decrypt($module_id);
        $this->lesson_id = decrypt($lesson_id);
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
        )->where('type', 'MC')->inRandomOrder()->get();

        if (sizeof($multiple_choice) > 0) {
            foreach ($multiple_choice as $item) {
                $item->choices = LessonQuestionChoice::where('question_id', $item->id)->inRandomOrder()->get();
            }
        }


 

        return view('livewire.forms.assessment-form', compact('multiple_choice'));
    }
}
