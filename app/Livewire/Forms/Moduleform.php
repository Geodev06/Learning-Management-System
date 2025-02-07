<?php

namespace App\Livewire\Forms;

use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use PgSql\Lob;

class Moduleform extends Component
{

    public $title, $overview, $no_of_lessons,
        $a_flag = FALSE, $r_flag = FALSE, $v_flag = FALSE, $k_flag = FALSE;

    public $id;

 

    #[On('show-modal')]
    public function show_modal($id, $action)
    {
        if ($id AND $action == 'Edit') {

            $this->id = $id;

            $module = Module::find($this->id);
            $this->title = $module->title;
            $this->overview = $module->overview;
            $this->no_of_lessons = $module->no_of_lessons;
            $this->a_flag = $module->a_flag == 1 ? TRUE : FALSE;
            $this->v_flag = $module->v_flag == 1 ? TRUE : FALSE;
            $this->k_flag = $module->k_flag == 1 ? TRUE : FALSE;
            $this->r_flag = $module->r_flag == 1 ? TRUE : FALSE;
        }

    }
    public function mount($action = 'Add')
    {
        if($action == 'Add') {
            $this->reset();
        }
    }

   

    public function submit($post_flag)
    {

        if ($this->a_flag == FALSE and $this->v_flag == FALSE and $this->r_flag == FALSE and $this->k_flag == FALSE) {
            session()->flash('error', 'Choose atleast one modality for this module.');
            return;
        }

        $data = $this->validate([
            'title' => 'required|string|max:250',
            'overview' => 'required|string|max:500',
            'no_of_lessons' => 'required|numeric|integer|max:50'
        ]);


        try {

            if (!$this->id) {

                $module = new Module();
                $module->title = $this->title;
                $module->overview = $this->overview;
                $module->no_of_lessons = $this->no_of_lessons;
                $module->a_flag = $this->a_flag == TRUE ? 1 : 0;
                $module->r_flag = $this->r_flag == TRUE ? 1 : 0;
                $module->v_flag = $this->v_flag == TRUE ? 1 : 0;
                $module->k_flag = $this->k_flag == TRUE ? 1 : 0;
                $module->post_flag = $post_flag;
                $module->created_by = Auth::user()->id;
                $module->save();

                $this->dispatch('close_modal', [
                    'title' => 'Success',
                    'message' => $this->lang['record_saved'],
                    'status' => 'success',

                ]);

                $this->dispatch('list-refresh');
                $this->reset();
            }

            if ($this->id) {
                $module = Module::find($this->id);
                $module->title = $this->title;
                $module->overview = $this->overview;
                $module->no_of_lessons = $this->no_of_lessons;
                $module->a_flag = $this->a_flag == TRUE ? 1 : 0;
                $module->r_flag = $this->r_flag == TRUE ? 1 : 0;
                $module->v_flag = $this->v_flag == TRUE ? 1 : 0;
                $module->k_flag = $this->k_flag == TRUE ? 1 : 0;
                $module->post_flag = $post_flag;
                $module->save();

                $this->dispatch('close_modal', [
                    'title' => 'Success',
                    'message' => $this->lang['record_updated'],
                    'status' => 'success',

                ]);

                $this->dispatch('list-refresh');
                $this->reset();
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.forms.moduleform');
    }
}
