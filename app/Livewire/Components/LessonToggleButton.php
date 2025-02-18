<?php

namespace App\Livewire\Components;

use App\Models\ModuleLesson;
use Livewire\Component;

class LessonToggleButton extends Component
{

    public $lesson_id;
    public $open_flag;

    public function mount($lesson_id)
    {
        $this->lesson_id = $lesson_id;

        $lesson = ModuleLesson::find($lesson_id);

        $this->open_flag = $lesson->open_flag;
    }

    public function toggle()
    {
        $lesson = ModuleLesson::find($this->lesson_id);

        $lesson->open_flag = $this->open_flag == 'Y' ? 'N' : 'Y';
        $this->open_flag = $this->open_flag == 'Y' ? 'N' : 'Y';

        $lesson->save();
    }

    public function render()
    {
        return view('livewire.components.lesson-toggle-button');
    }
}
