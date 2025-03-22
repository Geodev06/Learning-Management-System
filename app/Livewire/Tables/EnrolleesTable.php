<?php

namespace App\Livewire\Tables;

use App\Models\Assessment;
use App\Models\Module;
use App\Models\ModuleLesson;
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

    public function profile_preview($id)
    {
        $this->redirect(route('profile_preview', encrypt($id)));
    }
    
    public function render()
    {
        $enrollees = StudentModule::where('module_id', $this->module_id)->orderBy('created_at', 'desc')->paginate(10);

        $module = Module::find($this->module_id);

        $lessons_count = ModuleLesson::where('module_id', $this->module_id)->count();

        $total_activity = 0;

        if ($module->k_flag = 1) {
            $total_activity = $lessons_count * 4;
        }else {
            $total_activity = $lessons_count * 3;
        }

        foreach ($enrollees as $student) {
            $student->student_info = User::where('id', $student->created_by)->first();
            
            $student->progress = (Assessment::where([
                'module_id'=> $this->module_id,
                'created_by' => $student->created_by
            ])->count() / $total_activity) * 100;

            $student->user_assessments = Assessment::where([
                'module_id'=> $this->module_id,
                'created_by' => $student->created_by
            ])->count();
        }


        return view('livewire.tables.enrollees-table', compact('enrollees','total_activity'));
    }
}
