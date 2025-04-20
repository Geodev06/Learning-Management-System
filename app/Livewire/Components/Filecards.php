<?php

namespace App\Livewire\Components;

use App\Models\LessonAttachment;
use Livewire\Attributes\On;
use Livewire\Component;

class Filecards extends Component
{
    public $lesson_id;

    public $search;

    public function mount($lesson_id)
    {
        $this->lesson_id = $lesson_id;
    }

    #[On('file-uploaded')]
    public function render()
    {
        $files = LessonAttachment::where('lesson_id', $this->lesson_id)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('caption', 'like', '%' . $this->search . '%')
                        ->orWhere('orig_file_name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.components.filecards', compact('files'));
    }
}
