<?php

namespace App\Livewire\Components;

use App\Models\LessonAttachment;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Filecards extends Component
{
    public $lesson_id;

    public $search;

    public function mount($lesson_id)
    {
        $this->lesson_id = $lesson_id;
    }

    public function delete_item($id)
    {
        $item = LessonAttachment::find($id);

        try {

            DB::beginTransaction();
            if (File::exists($item->file_path) and ($item->file_type == 'PDF' or $item->file_type == 'VIDEO' or $item->file_type == 'AUDIO' or $item->file_type == 'IMAGES')) {
                File::delete($item->file_path);

                $item->delete();
            }
            DB::commit();

            $this->dispatch('close_modal', [
                'title' => 'Success',
                'message' => $this->lang['record_deleted'],
                'status' => 'success',

            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
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
