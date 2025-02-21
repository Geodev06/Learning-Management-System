<?php

namespace App\Livewire\Components;

use App\Models\LessonAttachment;
use App\Models\Module;
use App\Models\ModuleLesson;
use Livewire\Component;

class LessonPreview extends Component
{

    public $module_id, $lesson_id;


    public function take_assessment($module_id, $lesson_id)
    {
        // trigger assessment_mode\
        $this->redirect(route('module_assessment', ['module_id' => $module_id, 'lesson_id' => $lesson_id]));
    }

    public function mount($module_id, $lesson_id)
    {
        $this->module_id = $module_id;
        $this->lesson_id = $lesson_id;
    }
    public function render()
    {

        $module = Module::find($this->module_id);
        $lesson = ModuleLesson::where([
            'module_id' => $module->id,
            'id' => $this->lesson_id,

        ])->first();

        $lesson_files = LessonAttachment::where(
            [
                'lesson_id' => $this->lesson_id
            ]
        )->get();

        return view('livewire.components.lesson-preview', compact('module', 'lesson', 'lesson_files'));
    }
}
