<?php

namespace App\Livewire\Components;

use App\Models\LessonAttachment;
use Livewire\Attributes\On;
use Livewire\Component;

class Filecards extends Component
{
    public $lesson_id;

    public function mount($lesson_id)
    {
        $this->lesson_id = $lesson_id;
    }

    #[On('file-uploaded')]
    public function render()
    {
        $files = LessonAttachment::where('lesson_id', $this->lesson_id)->orderBy('created_at', 'desc')->get();
        return view('livewire.components.filecards', compact('files'));
    }
}
