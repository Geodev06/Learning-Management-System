<?php

namespace App\Livewire\Components;

use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class Deleteprompt extends Component
{

    public $id, $title;
    
    #[On('show-delete-modal')]
    public function get_id($id)
    {
        $this->id = $id;
        $module = Module::find($this->id);
        $this->title = ucfirst($module->title ?? '');
    }
    public function submit()
    {

        try {
            $module = Module::find($this->id);
            DB::beginTransaction();

            $module->delete();

            DB::commit();
            $this->dispatch('close_modal', [
                'title' => 'Success',
                'message' => $this->lang['record_deleted'],
                'status' => 'success',
            ]);

            $this->dispatch('list-refresh');
            $this->reset();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.components.deleteprompt');
    }
}
