<?php

namespace App\Livewire\Components;

use App\Models\Assessment;
use App\Models\LessonAttachment;
use App\Models\Module;
use App\Models\ModuleLesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LessonPreview extends Component
{

    public $module_id, $lesson_id;

    public $has_mc = false;
    public $has_e = false;
    public $has_i = false;
    public $has_ho = false;

    public function take_assessment($module_id, $lesson_id, $type)
    {
        // trigger assessment_mode\
        $this->redirect(route('module_assessment', ['module_id' => $module_id, 'lesson_id' => $lesson_id, 'type' => $type]));
    }

    public function mount($module_id, $lesson_id)
    {
        $this->module_id = $module_id;
        $this->lesson_id = $lesson_id;

        if(Assessment::where([
            'module_id' => $module_id,
            'lesson_id' => $lesson_id,
            'type' => 'MC',
            'created_by' => Auth::user()->id,

        ])->first()) {

            $this->has_mc = true;
        }

        if(Assessment::where([
            'module_id' => $module_id,
            'lesson_id' => $lesson_id,
            'type' => 'I',
            'created_by' => Auth::user()->id,

        ])->first()) {

            $this->has_i = true;
        }

        if(Assessment::where([
            'module_id' => $module_id,
            'lesson_id' => $lesson_id,
            'type' => 'E',
            'created_by' => Auth::user()->id,

        ])->first()) {

            $this->has_e = true;
        }

        if(Assessment::where([
            'module_id' => $module_id,
            'lesson_id' => $lesson_id,
            'type' => 'HO',
            'created_by' => Auth::user()->id,

        ])->first()) {

            $this->has_ho = true;
        }
       

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
