<?php

namespace App\Livewire\Tables;

use App\Models\StudentModule;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class EnrolleesTable extends Component
{

    use WithPagination;

    public $module_id;

    public function mount($module_id)
    {
        $this->module_id = $module_id;
    }
    public function render()
    {
        $enrollees = StudentModule::where('module_id', $this->module_id)->orderBy('created_at','desc')->paginate(10);

        foreach ($enrollees as $student) {
            $student->student_info = User::where('id', $student->created_by)->first();
        }


        return view('livewire.tables.enrollees-table', compact('enrollees'));
    }
}
